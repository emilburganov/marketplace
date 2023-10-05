<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index($product_id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::query()->find($product_id);

        return view('pages.product', compact(['product']));
    }

    public function setRating(Request $request, $product_id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validation->fails()) {
            return redirect()->back();
        }

        $user_id = Auth::id();

        $rating = UserProduct::query()
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($rating) {
            $rating->update([
                'rating' => $request->input('rating')
            ]);
        } else {
            UserProduct::query()->create([
               'user_id' => $user_id,
               'product_id' => $product_id,
               'rating' => $request->input('rating'),
            ]);
        }

        return redirect()->back();
    }

    public function create(Request $request): RedirectResponse
    {
        if (!$request->input('product_seller_id')) {
            $request['product_seller_id'] = Auth::id();
        }

        $validation = Validator::make($request->all(), [
            'product_name' => 'required|string|between:8,50',
            'product_description' => 'required|string|between:20,200',
            'product_image' => 'required|image|max:2048',
            'product_price' => 'required|integer|between:0,999999999',
            'product_discount' => 'required|integer|between:0,100',
            'product_category_id' => 'required|integer|exists:categories,id',
            'product_seller_id' => 'required|integer|exists:users,id',
        ]);

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        $image = $request->file('product_image');
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path('../resources/assets/images/cards'), $image_name);

        Product::query()->create([
            'name' => $request->input('product_name'),
            'description' => $request->input('product_description'),
            'image' => 'resources/assets/images/cards/' . $image_name,
            'price' => $request->input('product_price'),
            'discount' => $request->input('product_discount'),
            'category_id' => $request->input('product_category_id'),
            'seller_id' => $request->input('product_seller_id'),
        ]);

        $request->session()->flash('product_message', 'Product successfully created!');

        return redirect()->back();
    }

    public function edit(Request $request, $product_id): RedirectResponse
    {
        $product = Product::query()->find($product_id);
        $request->session()->flash('product_flash', $product);

        return redirect()
            ->back()
            ->withInput();
    }

    public function update(Request $request, $product_id): RedirectResponse
    {
        if (!$request->input('product_seller_id')) {
            $request['product_seller_id'] = Auth::user()['id'];
        }

        $validation = Validator::make($request->all(), [
            'product_name' => 'required|string|between:4,50',
            'product_description' => 'required|string|between:10,150',
            'product_image' => 'required|image|max:2048',
            'product_price' => 'required|integer|between:0,999999999',
            'product_discount' => 'required|integer|between:0,100',
            'product_category_id' => 'required|integer',
            'product_seller_id' => 'required|integer|exists:users,id',
        ]);

        $product = Product::query()->find($product_id);

        if ($validation->fails()) {
            $request->session()->flash('product_flash', $product);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        $image = $request->file('product_image');
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path('../resources/assets/images/cards'), $image_name);

        $product->update([
            'name' => $request->input('product_name'),
            'description' => $request->input('product_description'),
            'image' => 'resources/assets/images/cards/' . $image_name,
            'price' => $request->input('product_price'),
            'discount' => $request->input('product_discount'),
            'category_id' => $request->input('product_category_id'),
            'seller_id' => $request->input('product_seller_id'),
        ]);

        $request->session()->flash('product_message', 'Product successfully updated!');

        return redirect()->back();
    }

    public function delete($product_id): RedirectResponse
    {
        $product = Product::query()->find($product_id);
        $product->delete();

        session()->flash('product_message', 'Product successfully deleted!');

        return redirect()->back();
    }
}
