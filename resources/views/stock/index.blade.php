@extends('layouts.app')

@section('title', 'Estoque')

@section('content')
    <section class="panel">
        <div class="panel__header">
            <div>
                <h2>Estoque</h2>
                <p>Conteúdo de entradas e saídas de estoque será renderizado aqui.</p>
            </div>
            <a class="button" href="{{ Route::has('stock.create') ? route('stock.create') : '#' }}">Nova movimentação</a>
        </div>
    </section>
@endsection