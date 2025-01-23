<?php

use App\Http\Controllers\PizzaController;
use App\Http\Controllers\DrinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\OrderController;


Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::prefix('pizzas')->group(function () {
    Route::get('/', [PizzaController::class, 'index'])->name('pizzas.index');
    Route::get('/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::post('/', [PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/{pizza}', [PizzaController::class, 'show'])->name('pizzas.show');
    Route::get('/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');
    Route::put('/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
    Route::delete('/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
});

Route::prefix('drinks')->group(function () {
    Route::get('/', [DrinkController::class, 'index'])->name('drinks.index');
    Route::get('/create', [DrinkController::class, 'create'])->name('drinks.create');
    Route::post('/', [DrinkController::class, 'store'])->name('drinks.store');
    Route::get('/{drink}', [DrinkController::class, 'show'])->name('drinks.show');
    Route::get('/{drink}/edit', [DrinkController::class, 'edit'])->name('drinks.edit');
    Route::put('/{drink}', [DrinkController::class, 'update'])->name('drinks.update');
    Route::delete('/{drink}', [DrinkController::class, 'destroy'])->name('drinks.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{type}/{id}', [CartController::class, 'addToCart'])->name('cart.add');;
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/delete', [CartController::class, 'deleteFromCart'])->name('cart.delete');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
