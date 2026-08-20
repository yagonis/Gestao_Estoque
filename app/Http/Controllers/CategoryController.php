<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Listagem de categorias
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Criação de categoria
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    /**
     * Listar categoria específica
     */
    public function show(Category $category)
    {
        
        return response()->json($category);
    }

    /**
     * Atualizar categoria
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:category,name,',
        ]);

        $category->update($validatedData);
        return response()->json($category);
    }

    /**
     * Deletar categoria
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
