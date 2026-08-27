<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

// Rotas de autenticação
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.authenticate');

});

// Rotas autenticadas
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Produtos - qualquer usuário autenticado pode visualizar
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    // Categorias - qualquer usuário autenticado pode visualizar
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    // Estoque
    Route::get('/stock', [StockController::class, 'index'])
        ->name('stock.index');

    // Apenas administradores
    Route::middleware('admin')->group(function () {

        // Produtos
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        // Categorias
        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        // Estoque
        Route::view('/stock/create', 'stock.create')
            ->name('stock.create');
    });
});