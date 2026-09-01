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


    {{-- Modal de edição --}}

    <div id="editUserModal"
        class = "fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4 py-8 backdrop-blur-sm">

        <div class="relative w-full max-w-xl min-h-[80vh] overflow-y-auto rounded-3xl border border-pink-100 bg-white shadow-2xl shadow-slate-900/20">

            <div class="flex items-center justify-between border-b border-slate-100 px-7 py-5">

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-pink-500">
                Usuários
            </p>

            <h2 class="mt-1 text-2xl font-bold text-slate-900">
                Editar usuário
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Atualize as informações do usuário.
            </p>
        </div>

        <button
            type="button"
            id="closeEditUserModal"
            class="flex h-10 w-10 items-center justify-center rounded-full text-xl text-slate-400 transition hover:bg-pink-50 hover:text-pink-500"
            aria-label="Fechar"
        >
            &times;
        </button>

    </div>


    {{-- Formulário --}}
    <form
        id="editUserForm"
        method="POST"
        class="space-y-5 p-7"
    >

        @csrf
        @method('PUT')


        {{-- Nome --}}
        <div>
            <label
                for="editName"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Nome do usuário
            </label>

            <input
                type="text"
                name="name"
                id="editName"
                required
                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:ring-4 focus:ring-pink-100"
                placeholder="Nome do usuário"
            >
        </div>



        {{-- Email --}}
        <div>
            <label
                for="editEmail"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                E-mail do usuário
            </label>

            <input
                type="email"
                name="email"
                id="editEmail"
                required
                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:ring-4 focus:ring-pink-100"
                placeholder="E-mail do usuário"
            >
        </div>


        {{-- Ações --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

            <button
                type="button"
                id="cancelEditUser"
                class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="rounded-2xl bg-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-100"
            >
                Salvar alterações
            </button>

        </div>

    </form>
        </div>
    </div>

    @foreach ($users as $user)
    
    <div class="user-card relative">
        <button
        type="button"
        class="edit-user absolute right-3 top-3 z-10 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full border border-white/70 bg-white/90 text-slate-500 shadow-md backdrop-blur-sm transition hover:scale-105 hover:bg-black hover:text-white"
        data-id="{{ $user->id }}"
        data-name="{{ $user->name }}"
        data-email="{{ $user->email }}"
        title="Editar usuário"
    >
        ✎
    </button>
            <h3>{{ $user->name }}</h3>
            <p>{{ $user->email }}</p>
        </div>
    @endforeach

</div> 
    
@endsection