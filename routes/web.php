<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProductController;
//use App\Http\Controllers\CategoryController;
//use App\Http\Controllers\StockController;
//use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\UserController;

Route::view('/', 'auth.login')->name('login');

Route::view('/dashboard', 'dashboard.index')->name('dashboard.index');

Route::view('/products', 'products.index')->name('products.index');
Route::view('/products/create', 'products.create')->name('products.create');

Route::view('/categories', 'categories.index')->name('categories.index');
Route::view('/categories/create', 'categories.create')->name('categories.create');

Route::view('/stock', 'stock.index')->name('stock.index');
Route::view('/stock/create', 'stock.create')->name('stock.create');
