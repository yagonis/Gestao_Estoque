<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
//use App\Http\Controllers\CategoryController;
//use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


//Auth Routes
Route::get('/login', [AuthController::class, 'create'])
->middleware('guest')
->name('login');

Route::post('/login', [AuthController::class, 'login'])
->middleware('guest')
->name('login.authenticate');

//Rotas que precisam de autenticação
Route::middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');


    Route::view('/categories', 'categories.index')->name('categories.index');
    Route::view('/stock', 'stock.index')->name('stock.index');


    Route::middleware('admin')->group(function() {
        
        Route::get('/products/create', [ProductController::class, 'create'])
        -> name('products.create');
    
        Route::post('/products', [ProductController::class, 'store'])
        -> name('products.store');
    
        //Categories Routes
        Route::view('/categories/create', 'categories.create')->name('categories.create');
    
        //Stock Routes
        Route::view('/stock/create', 'stock.create')->name('stock.create');
    });
});
