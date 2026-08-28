@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
    <section class="panel">
        <div class="panel__header">
            <div>
                <h2>Usuários Cadastrados </h2>
            </div>
        

    </section>
    
        <div class="user-grid">

    <a href="{{ route('users.create') }}" class="user-card user-card--add">
        <x-heroicon-o-plus class="user-card__icon" />
        <span>Adicionar Usuário</span>
    </a>

    @foreach ($users as $user)
        <div class="user-card">
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
        </div>
    @endforeach

</div> 
    
@endsection