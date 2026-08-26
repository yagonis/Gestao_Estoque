@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="panel">
        <form method="POST" action="{{ route('categories.store') }}" class="space-y"
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nome da Categoria</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    placeholder="Nome da Categoria"
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('name') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                    required
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
             
                <br>

            <div>
                    <button type="submit" class="w-full rounded-2xl bg-pink-400 px-4 py-3 text-sm font-medium text-white transition hover:bg-pink-500 focus:outline-none focus:ring-4 focus:ring-pink-100">
                        Cadastrar Categoria
                    </button>
            </div>
    </div>

@endsection

