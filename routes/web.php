<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.menu');
});

route::get('/cart', function () {
    return view('customer.cart');
})->name('cart');

route::get('/checkout', function () {
    return view('customer.checkout');
})->name('checkout');