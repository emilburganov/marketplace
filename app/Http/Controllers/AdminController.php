<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->paginate(4, ['*'], 'users-page');
        $roles = Role::all();
        $categories = Category::query()->paginate(6, ['*'], 'categories-page');
        $products = Product::query()->paginate(4, ['*'], 'products-page');
        $sellers = User::query()->where('role_id', '3')->get();

        return view('pages.admin', compact(['users', 'roles', 'categories', 'products', 'sellers']));
    }
}
