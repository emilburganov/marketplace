<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{id}', [ProductController::class, 'index'])->name('product');

Route::middleware('guest')->group(function() {
    /* Auth */
    Route::get('/signup', [AuthController::class, 'getSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'postSignup'])->name('postSignup');
    Route::get('/signin', [AuthController::class, 'getSignin'])->name('signin');
    Route::post('/signin', [AuthController::class, 'postSignin'])->name('postSignin');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');

    /* Rating */
    Route::post('/rating/product/{id}', [ProductController::class, 'setRating'])->name('setRating');

    /* Cart */
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/product/{id}', [CartController::class, 'create'])->name('createCart');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('updateCart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('deleteCart');

    /* Seller Or Admin */
    Route::middleware('role:2,3')->group(function() {
        Route::get('/seller', [SellerController::class, 'index'])->name('seller');

        /* Products */
        Route::post('/products', [ProductController::class, 'create'])->name('createProduct');
        Route::get('/products/{id}', [ProductController::class, 'edit'])->name('editProduct');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('updateProduct');
        Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('deleteProduct');
    });

    /* Admin */
    Route::middleware('role:2')->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');

        /* Users */
        Route::post('/users', [UserController::class, 'create'])->name('createUser');
        Route::get('/users/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('updateUser');
        Route::delete('/users/{id}', [UserController::class, 'delete'])->name('deleteUser');

        /* Categories */
        Route::post('/categories', [CategoryController::class, 'create'])->name('createCategory');
        Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('editCategory');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('updateCategory');
        Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('deleteCategory');

        /* Products */
        Route::post('/products', [ProductController::class, 'create'])->name('createProduct');
        Route::get('/products/{id}', [ProductController::class, 'edit'])->name('editProduct');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('updateProduct');
        Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('deleteProduct');
    });
});
