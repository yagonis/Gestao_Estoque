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
        <div class="p-4 rounded-lg shadow-md shadow-slate-900/5 w-2/3">
            <div>
                
            </div>
        </div>
        <div class="p-4 rounded-lg shadow-md shadow-slate-900/5 w-2/3">

        </div>
    </div>
@endsection