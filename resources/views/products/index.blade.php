@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <section class="panel">
        <div class="panel__header">
            <div>
                <h2> Produtos </h2>
                <p> Gerencie os produtos cadastrados no sistema. </p>
            </div>
        <a class="button" href="{{ Route::has('products.create') ? route('products.create') : '#' }}"> Novo Produto </a>
        </div>
    </section>
@endsection