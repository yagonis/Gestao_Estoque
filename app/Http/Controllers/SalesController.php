<?php

namespace App\Http\Controllers;
use App\Http\Resources\SalesResource;
use App\Http\Requests\StoreSalesRequest;
use App\Models\Sales;
use App\Models\Product;
use App\Models\salesItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        return view('sales.index', compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
    {
        $items = $request->validated()['items'];

        return DB::transaction(function () use ($items) {

            $total = 0;

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);

            $subtotal = $product->price * $item['quantity'];
            // Aqui você pode fazer algo com o subtotal, por exemplo, salvar em um banco de dados ou calcular impostos.

            $total += $subtotal;
        }

        $sale = Sales::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'sale_date' => now(),
            'status' => 'completed', // ou outro status inicial que você queira
        ]);

        foreach ($items as $item) {
            $product = Product::lockForUpdate()->findOrFail($item['product_id']);

            $quantity = $item['quantity'];

            //Verificar estoque
            if( $product->quantity < $quantity){
                throw new \Exception(
                    "Estoque insuficiente para o produto: {$product->name}"
                );
            }
            
            $unitPrice = $product->price;
            $subtotal = $unitPrice * $quantity;

            SalesItems::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $totalPrice += $subtotal;

            $product->decrement('quantity', $quantity);
        }

        $sale->update(['total_price' => $totalPrice]);

        return redirect()
        ->route('sales.index')
        ->with('success', 'Venda criada com sucesso!');

        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        return new SalesResource($sales);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSalesRequest $request, Sales $sales)
    {
        $validatedData = $request->validated();
        $sales->update($validatedData);

        return redirect()->route('sales.index')->with('success', 'Venda atualizada com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        $sales->delete();
        return response()->json(['message' => 'Venda removida com sucesso!']);
    }

    
}
