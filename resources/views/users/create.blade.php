@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

    <div class="panel">
        <div>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nome</label>
                    <input type="text" name="name" id="name" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('name') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('email') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" minlength="8" id="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('name') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                </div>
                <div>
                    <select name="role" id="role" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('name') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                        <option value="">Selecione uma função</option>
                        <option value="admin">Administrador</option>
                        <option value="user">Usuário</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="button">Criar Usuário</button>
                </div>
            </form>
        </div>
    </div>

@endsection