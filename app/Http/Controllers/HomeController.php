<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->paginate(32);
        $products = Product::query()->paginate(32);
        $sales_products = Product::query()->orderBy('discount')->paginate(32);
        $best_selling_products = Product::query()->paginate(4);

        return view('pages.home',
            compact(['categories', 'products', 'sales_products', 'best_selling_products']));
    }
}
