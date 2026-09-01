<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;

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

        Route::get('/products/edit', [ProductController::class, 'edit'])
            ->name('products.edit');
        
        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        // Categorias
        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        // Estoque
        Route::get('/stock/create', [StockController::class, 'create'])
            ->name('stock.create');

        Route::post('/stock', [StockController::class, 'store'])
            ->name('stock.store');

        // Usuários
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::put('users/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::get('/users/edit', [UserController::class, 'edit'])
            ->name('users.edit');
    });
});