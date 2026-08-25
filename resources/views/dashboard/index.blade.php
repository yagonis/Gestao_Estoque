@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="card-grid">
        <article class="card">
            <span class="card__label"> Produtos Cadastrados </span>
            <strong class="card__value"> {{ $totalProducts ?? 0 }} </strong>
        </article>

        <article class="card">
            <span class="card__label"> Produtos em estoque baixo </span>
            <strong class="card__value"> {{ $lowStockProducts ?? 0 }} </strong>
        </article>

        <article class="card">
            <span class="card__label"> Produtos fora de estoque </span>
            <strong class="card__value"> {{ $outOfStockProducts ?? 0 }} </strong>
        </article>
    </section>

    <section class="panel">
        <h2> Bem vindo ao Dashboard do Glamour Make </h2>
        <p> Use o menu lateral para navegar entre as funcionalidades do sistema. </p>
    </section>
@endsection