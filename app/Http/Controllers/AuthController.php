<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getSignup(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.auth.signup');
    }

    public function postSignup(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
           'name' => 'required|string|min:4',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string|between:8,100',
           'password_repeat' => 'required|string|same:password',
        ]);

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        $user = User::query()->create($request->except('password_repeat'));

        Auth::login($user);

        return redirect()->route('home');
    }

    public function getSignin(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.auth.signin');
    }

    public function postSignin(Request $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $validation = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withErrors($validation->errors());
        }

        if (!Auth::attempt($credentials)) {
            return redirect()
                ->back()
                ->withErrors(['message' => 'Invalid email or password, please try again.']);
        }

        return redirect()->route('home');
    }

    public function getLogout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('signin');
    }
}
