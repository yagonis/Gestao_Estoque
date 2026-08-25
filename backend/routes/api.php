<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/products/low-stock', [ProductController::class, 'lowStock'] );


Route::apiResource('category', CategoryController::class);

Route::apiResource('stock', StockController::class);

Route::get('/dashboard/summary', [DashboardController::class, 'summary']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    

    //Qualquer usuário pode ter acesso
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    //Apenas Administradores podem ter acesso
    Route::middleware('admin')->group(function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum', 'admin')->group(function () {
    Route::apiResource('users', UserController::class);
});