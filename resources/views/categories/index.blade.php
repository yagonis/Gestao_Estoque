@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <section class="panel">
        <div class="panel_header">
            <div>
                <h2> Categorias</h2>
                <p> Conteúdo de Cateogorias </p>
            </div>
            <a class="button" href="{{ Route::has('categories.create') ? route('categories.create') : "#" }}">Nova Categoria</a>
        </div>
    </section>
@endsection