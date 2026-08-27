@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <section class="panel flex flex-row justify-between">
        <div class="panel__header">
            <div class="">
                <p> Cadastro de novos produtos no sistema</p>
            </div>
            <a class="button" href="{{ Route::has('products.create') ? route('products.create') : '#' }}"> Novo Produto </a>
        </div>
        <div class="panel__header">
            <div class="">
                <p> Atualização de produtos existentes</p>
            </div>
            <a class="button" href="{{ Route::has('products.create') ? route('products.create') : '#' }}"> Atualizar Produto </a>
        </div>
    </section>


@endsection