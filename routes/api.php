<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesItemController;
use Illuminate\Support\Facades\Route;

Route::get('/products/low-stock', [ProductController::class, 'lowStock'] );


Route::get('/dashboard/summary', [DashboardController::class, 'summary']);

Route::post('/auth/login', [AuthController::class, 'LoginApi']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    

    //Qualquer usuário pode ter acesso
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::get('/stock', [StockController::class, 'index']);
    Route::get('/sales', [SalesController::class, 'index']);
    Route::post('/sales', [SalesController::class, 'store']);
    Route::delete('/sales/{sale}', [SalesController::class, 'destroy']);
    Route::get('/sales/{sales}', [SalesController::class, 'show']);
    Route::get('/sales-items', [SalesItemController::class, 'index']);
    Route::post('/sales-items', [SalesItemController::class, 'store']);
    Route::get('/sales-items/{salesItems}', [SalesItemController::class, 'show']);
    Route::put('/sales-items/{salesItems}', [SalesItemController::class, 'update']);
    Route::delete('/sales-items/{salesItems}', [SalesItemController::class, 'destroy']);


    //Apenas Administradores podem ter acesso
    Route::middleware('admin')->group(function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    Route::post('/stock', [StockController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });

});
