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

    <div clas="flex flex-col gap-4 mt-6">
        <div class="bg-yellow-400 p-4 rounded-lg shadow-md shadow-slate-900/5">
            <div>

            </div>
        </div>
        <div class="bg-green-600 p-4 rounded-lg shadow-md">

        </div>
    </div>
@endsection