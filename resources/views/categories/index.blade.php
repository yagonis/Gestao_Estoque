@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <section class="panel">
        <div class="panel__header">
            <div>
                <h2> Categorias</h2>
                <p> Conteúdo de Cateogorias </p>
            </div>
            <a class="button" href="{{ Route::has('categories.create') ? route('categories.create') : "#" }}">Nova Categoria</a>
        </div>
    </section>


    <section class="panel mt-4">
        <div class="panel__header">
            <div>
                <h2> Categorias Cadastradas </h2>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
    @foreach ($categories as $category)

        <div class="flex min-h-32 overflow-hidden rounded-lg border border-slate-100 bg-white shadow-md shadow-slate-900/5">
            <div class="flex flex-1 items-center p-6">
                <h3 class="text-lg font-semibold text-slate-900">
                    {{ $category->name }}
                </h3>
            </div>
            <div class="flex w-32 items-center justify-center bg-gray-200">
                <strong>
                    {{ $category->products->count() }} Produtos
                </strong>
            </div>

        </div>

    @endforeach
</div>

@endsection