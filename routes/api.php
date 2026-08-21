<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/products/low-stock', [ProductController::class, 'lowStock'] );
Route::apiResource('products', ProductController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('stock', StockController::class);