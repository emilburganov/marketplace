<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $cart = Auth::user()['cart'];

        if ($cart->count()) {
            $cart = Auth::user()
                ->cart()
                ->rightJoin('products', 'products.id', '=', 'carts.product_id')
                ->select(DB::raw('*, discount_price * count AS total, carts.id as id'))
                ->get();
        }

        return view('pages.cart', compact(['cart']));
    }

    public function create($product_id): RedirectResponse
    {
        $user_id = Auth::id();
        $cart = Cart::query()
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart) {
            $cart->update([
                'count' => $cart['count'] + 1,
            ]);
        } else {
            Cart::query()->create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'count' => '1'
            ]);
        }

        return redirect()->back();
    }

    public function update(Request $request, $cart_id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
           'count' => 'required|integer|between:0,999999999',
        ]);

        if ($validation->fails()) {
            return redirect()->back();
        }

        $count = $request->input('count');
        $cart = Cart::query()->find($cart_id);

        $cart->update([
            'count' => $count,
        ]);

        if ($count <= 0) {
            $this->delete($cart_id);
        }

        return redirect()->back();
    }

    public function delete($cart_id): RedirectResponse
    {
        $cart = Cart::query()->find($cart_id);
        $cart->delete();

        return redirect()->back();
    }
}
