<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sales;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function summary()
    {
        $totalProducts = Product::count();

        $outOfStock = Product::where('quantity', 0)->count();

        $LowStock = Product::whereColumn(
            'quantity', '<=', 'minimum_stock'
        ) ->count();

        return response()->json([
            'total_products' => $totalProducts,
            'out_of_stock' => $outOfStock,
            'low_stock' => $LowStock
        ]);
    }

    public function index()
    {
    
    $sales = Sales::with('user')->latest()->get();
    
    return view('dashboard.index', compact('sales'));
    }
    
    public function getProducts()
    {
        $products = Product::all();
        return view('dashboard.index', compact('products'));
    }
}
