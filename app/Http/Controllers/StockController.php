<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('product')->get();
        return response()->json($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'type' => 'required|in:entry,exit',
        'quantity' => 'required|integer|min:1'
       ]);

       $product = Product::findOrFail($validatedData['product_id']);

       if($validatedData['type'] === 'entry') {
        $product->quantity += $validatedData['quantity'];
       }

       if ($validatedData['type'] === 'exit') {
        if($product->quantity < $validatedData['quantity']) {
            return response()->json(['error' => 'Insufficient stock for this product.'], 422);
        }
        $product->quantity -= $validatedData['quantity'];
       }

       $product->save();
       
       $movement = Stock::create($validatedData);
        return response()->json($movement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entry,exit',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        if($validatedData['type'] === 'entry') {
            $product->quantity += $validatedData['quantity'];
        }

        if ($validatedData['type'] === 'exit') {
            if($product->quantity < $validatedData['quantity']) {
                return response()->json(['error' => 'Insufficient stock for this product.'], 422);
            }
            $product->quantity -= $validatedData['quantity'];
        }

        $product->save();

        $stock->update($validatedData);
        return response()->json($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
