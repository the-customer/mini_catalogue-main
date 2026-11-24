<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{id}',[CartController::class,'add'])->name('cart.add');
Route::post('/cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
Route::post('/cart/clear',[CartController::class,'clear'])->name('cart.clear');
Route::post('/cart/increment/{id}',[CartController::class,'increment'])->name('cart.increment');
Route::post('/cart/change/{id}/{sens}',[CartController::class,'changeQty'])->name('cart.changeQty');

