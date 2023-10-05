<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        $products = Product::query()->where('seller_id', Auth::id())->get();

        return view('pages.seller', compact(['categories', 'products']));
    }
}
