<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;

class CatalogController extends Controller
{
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (isset($_GET['search'])) {
            Session::put('search', $request->input('search'));
        }
        if ($request->input('price_from') !== null) {
            Session::put('price_from', $request->input('price_from'));
        }
        if ($request->input('price_to') !== null) {
            Session::put('price_to', $request->input('price_to'));
        }
        if ($request->input('discount_from') !== null) {
            Session::put('discount_from', $request->input('discount_from'));
        }
        if ($request->input('discount_to') !== null) {
            Session::put('discount_to', $request->input('discount_to'));
        }
        if ($request->input('category_id') !== null) {
            Session::put('category_id', $request->input('category_id'));
        }
        if ($request->input('sorting') !== null) {
            Session::put('sorting', $request->input('sorting'));
        }

        $products = Product::query()
            ->when(request('price_from'), function ($query) {
                return $query->where(
                    'discount_price', '>=', request('price_from')
                );
            })
            ->when(Session::get('price_from'), function ($query) {
                return $query->where(
                    'discount_price', '>=', Session::get('price_from')
                );
            })

            ->when(request('price_to'), function ($query) {
                $query->where('discount_price', '<=', request('price_to'));
            })
            ->when(Session::get('price_to'), function ($query) {
                return $query->where('discount_price', '<=', Session::get('price_to'));
            })

            ->when(request('discount_from'), function ($query) {
                return $query->where('discount', '>=', request('discount_from'));
            })
            ->when(Session::get('discount_to'), function ($query) {
                return $query->where('discount', '<=', Session::get('discount_to'));
            })

            ->when(request('category_id')
                && request('category_id') !== 'all', function ($query) {
                return $query->where('category_id', '=', request('category_id'));
            })
            ->when(Session::get('category_id')
                && Session::get('category_id') !== 'all', function ($query) {
                return $query->where('category_id', '=', Session::get('category_id'));
            })


            ->when(request('sorting'), function ($query) {
                $params = explode('-', request('sorting'));
                return $query->orderBy($params[0], $params[1]);
            })
            ->when(Session::get('sorting'), function ($query) {
                $params = explode('-', Session::get('sorting'));
                return $query->orderBy($params[0], $params[1]);
            })

            ->when(request('search'), function ($query) {
                return $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->when(Session::get('search'), function ($query) {
                return $query->where('name', 'like', '%' . Session::get('search') . '%');
            });

        $products_info = [
            'count' => $products->count(),
            'min_price' => Product::query()->min('discount_price'),
            'max_price' => Product::query()->max('discount_price'),
            'min_discount' => Product::query()->min('discount'),
            'max_discount' => Product::query()->max('discount'),
        ];

        $products = $products->paginate(8, ['*'], 'catalog-page');

        $categories = Category::all();

        session()->flashInput($request->input());

        return view('pages.catalog', compact(['products', 'products_info', 'categories']));
    }
}
