@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <section class="panel flex flex-row justify-between">
        <div class="panel__header">
            <div class="">
                <p> Cadastro de novos produtos no sistema</p>
            </div>
            <a class="button" href="{{ Route::has('products.edit') ? route('products.create') : '#' }}"> Novo Produto </a>
        </div>
        <div class="panel__header ">
            <div class="">
                <p> Atualização de produtos existentes</p>
            </div>
            <a class="button" href="{{ Route::has('products.create') ? route('products.edit') : '#' }}"> Atualizar Produto </a>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
        @foreach ($products as $product)
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                
                {{-- Imagem --}}
                <div class="aspect-square bg-slate-100">
                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <div class="flex h-full items-center justify-center text-sm text-slate-400">
                            Sem imagem
                        </div>
                    @endif
                </div>

                {{-- Informações do produto --}}
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-slate-900">
                        {{ $product->name }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $product->category->name }}
                    </p>


                    {{-- Quantidade --}}
                    <div class="mt-4 flex items-center justify-between">

                        <span class="text-sm text-slate-500">
                            Estoque
                        </span>

                        <span class="text-lg font-bold text-slate-900">
                            {{ $product->quantity }}
                        </span>

                    </div>
                </div>
            </div>
        
        @endforeach
    </div>


@endsection