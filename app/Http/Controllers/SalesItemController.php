<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreSalesItemRequest;
use App\Http\Resources\SalesItemResource;
use App\Models\SalesItems;

use Illuminate\Http\Request;

class SalesItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesItem = SalesItems::all();
        return view('salesItem.index', compact('salesItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesItemRequest $request)
    {
        $validatedData = $request->validated();

        SalesItems::create($validatedData);
        return redirect()->route('salesItem.index')->with('success', 'Item de venda criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesItems $salesItems)
    {
        return new SalesItemResource($salesItems);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSalesItemRequest $request, SalesItems $salesItems)
    {
        $validatedData = $request->validated();
        $salesItems->update($validatedData);

        return redirect()->route('salesItem.index')->with('success', 'Item de venda atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesItems $salesItems)
    {
        $salesItems->delete();
        return response()->json(['message' => 'Item de venda removido com sucesso!']);
    }
}
