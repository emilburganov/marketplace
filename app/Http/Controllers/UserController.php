<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'user_name' => 'required|string|min:4',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|between:8,100',
            'user_password_repeat' => 'required|string|same:user_password',
            'user_role_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        User::query()->create([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'password' => $request->input('user_password'),
            'password_repeat' => $request->input('user_password_repeat'),
            'role_id' => $request->input('user_role_id'),
        ]);

        $request->session()->flash('user_message', 'User successfully created!');

        return redirect()->back();
    }

    public function edit(Request $request, $user_id): RedirectResponse
    {
        $user = User::query()->find($user_id);
        $request->session()->flash('user_flash', $user);

        return redirect()
            ->back()
            ->withInput();
    }

    public function update(Request $request, $user_id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'user_name' => 'required|string|min:4',
            'user_email' => 'required|email|unique:users,email,' . $user_id,
            'user_password' => 'required|string|between:8,100',
            'user_password_repeat' => 'required|string|same:user_password',
            'user_role_id' => 'required|integer',
        ]);

        $user = User::query()->find($user_id);

        if ($validation->fails()) {
            $request->session()->flash('user_flash', $user);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        $user->update([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'password' => $request->input('user_password'),
            'password_repeat' => $request->input('user_password_repeat'),
            'role_id' => $request->input('user_role_id'),
        ]);

        $request->session()->flash('user_message', 'User successfully updated!');

        return redirect()->back();
    }

    public function delete($user_id): RedirectResponse
    {
        $user = User::query()->find($user_id);
        $user->delete();

        session()->flash('user_message', 'User successfully deleted!');

        return redirect()->back();
    }
}
