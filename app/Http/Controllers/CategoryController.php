<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Listagem de categorias
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Criação de categoria
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Listar categoria específica
     */
    public function show(Category $category)
    {
        
        return new CategoryResource($category);
    }

    /**
     * Atualizar categoria
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
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

    public function create()
    {
        return view('categories.create');
    }
}
