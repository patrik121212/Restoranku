<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return redirect()->route('menu');;
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/card/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [MenuController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [MenuController::class, 'removeCart'])->name('cart.remove');
Route::get('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');
Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store', [MenuController::class, 'storeOrder'])->name('checkout.store');
Route::get('/checkout/success/{orderId}', [MenuController::class, 'checkoutSuccess'])->name('checkout.success');


// Admin Routes
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// routesrole admin middleware group
Route::middleware('role:admin|chasier')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
// // settlement route
// Route::middleware('role:admin|chasier')->group(function () {
//     Route::post('orders/settlement/{order}', [OrderController::class, 'settlement'])->name('orders.settlement');
// });
// Route::middleware('role:admin|chef')->group(function () {
//     Route::post('orders/cooked/{order}', [OrderController::class, 'cooked'])->name('orders.cooked');
// });
// kasir, chef dan admin middleware group
Route::middleware('role:admin|chasier|chef')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('orders', OrderController::class);
    Route::post('items/update-status/{order}', [ItemController::class, 'updateStatus'])->name('items.updateStatus');
    Route::post('orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
