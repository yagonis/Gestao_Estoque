<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    //Listagem de produtos
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    //Criação de produto
    public function store(StoreProductRequest $request)
    {
       $validatedData = $request->validated();
       
       $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    //Buscar produto específico
    public function show(Product $product)
    {
       return new ProductResource($product);
    }

    //Atualizar produto
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
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
