<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //Listagem de produtos
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    //Criação de produto
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:category,id',
            'minimum_stock' => 'required|integer|min:0',
       ]);



       $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    //Buscar produto específico
    public function show(Product $product)
    {
       $product->load('category');
       
        return response()->json($product);
    }

    //Atualizar produto
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:category,id',
        ]);


        $product->update($validatedData);
        return response()->json($product);
    }

    //Excluir produto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Produto removido com sucesso!']);
    }

    public function lowStock()
    {
        $products = Product::with('category')->whereColumn('quantity', '<=', 'minimum_stock')->get();
        return response()->json($products);

    }

    
}
