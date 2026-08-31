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

        <div class="user-grid mt-4">

            @foreach ($categories as $category)
                <table>
                    <thead>
                        <tr>
                            <th>
                                {{ $category->name }}
                            </th>
                        </tr>
                    </thead>
                </table>
            @endforeach

        </div>
    </section>

@endsection