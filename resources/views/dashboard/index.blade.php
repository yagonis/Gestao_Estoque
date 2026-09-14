@extends('layouts.app')

@section('title', 'Dashboard')

@php
    $products = \App\Models\Product::all();
@endphp

@section('content')
    <section class="card-grid">
        <article class="card">
            <span class="card__label"> Produtos Cadastrados </span>
            <strong class="card__value"> {{ $products->count() }} </strong>
        </article>

        <article class="card">
            <span class="card__label"> Produtos em estoque baixo </span>
            <strong class="card__value"> 
                {{ $products->filter(fn ($product) => $product->quantity < $product->minimum_stock)->count() }} 
             </strong>
        </article>

        <article class="card">
            <span class="card__label"> Produtos fora de estoque </span>
            <strong class="card__value"> {{ $products->filter(fn ($product) => $product->quantity === 0)->count() }} </strong>
        </article>
    </section>

    <div class="flex justify-between gap-4 mt-6 h-full">
        <div class=" card p-4 rounded-lg shadow-md shadow-slate-900/5 w-2/3">
            <div>
                <span class="card__label"> Movimentações de produtos </span>
            </div> 
        </div>
        <div class="card p-4 rounded-lg shadow-md shadow-slate-900/5 w-2/3">
            <h2 class="mt-4 space-y-3">
                Histórico de vendas
            </h2>

            <div class="mt-4 space-y-3">
                @forelse ($sales as $sale)
                    <div class="rounded-lg bg-white p-4 shadow">
                        <div class="flex justify-between">
                            <div>
                            <p class="font-semibold"> Venda #{{ $sale->id }}</p>
                            
                            <p class="text-sm text-gray-500"> Realizada por: {{ $sale->user->name }}</p>

                            <p class="text-sm text-gray-500">
                            {{ $sale->sale_date }}
                            </p>
                            </div>    
                        </div>
                    </div>
                <div>
                        <p class="font-bold">
                            R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">
                Nenhuma venda realizada ainda.
            </p>
        @endforelse
            </div>
        </div>
@endsection