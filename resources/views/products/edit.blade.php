@extends('layouts.app')

@section('title', 'Edição de Produto')

@section('content')
    <section class="panel">
        <h2> Edição de Produto </h2>
        <p> Atualize as informações do produto no sistema </p>
    </section>

    <section class="panel">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('products.form')

            <div class="mt-4">
                <button type="submit" class="button"> Atualizar Produto </button>
            </div>
        </form>
    </section>

@endsection