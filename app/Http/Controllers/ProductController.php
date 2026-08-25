<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class ProductController extends Controller
{
    //Listagem de produtos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    //Criação de produto
    public function store(StoreProductRequest $request)
    {
       $validatedData = $request->validated();
       
        Product::create($validatedData);

       return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
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

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    
}
