<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Http\Requests\StoreStockRequest;
use App\Http\Resources\StockResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('product')->latest()->get();

        $products = Product::orderBy('name')->get();
        
        return view('stock.index', compact('stocks', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {
       $validatedData = $request->validated();

        try {
            $movement = DB::transaction(function () use ($validatedData) {
                $product = Product::where('id', $validatedData['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($validatedData['type'] === 'entry') {
                    $product->quantity += $validatedData['quantity'];
                } else {
                    if ($product->quantity < $validatedData['quantity']) {
                        abort(response()->json(['message' => 'Insufficient stock for this exit movement.'], 422));
                    }
                    $product->quantity -= $validatedData['quantity'];
                }

                $product->save();

                return Stock::create($validatedData);
            });

            return redirect()->route('stock.index')->with('success', 'Movimento de estoque registrado com sucesso!');
            
        } catch (\Throwable $e) {
            Log::error('Error creating stock movement', [
                'error' => $e->getMessage(),
                'payload' => $validatedData
            ]);

            return response()->json(['message' => 'Internal server error.'], 500);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
