@extends('layouts.app')

@section('title', 'Login')
@section('hideSidebar', true)
@section('hideHeader', true)

@section('content')
    <section class="flex h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-pink-50 via-white to-rose-100 px-4">
        <div class="w-full max-w-md rounded-3xl border border-pink-100 bg-white/90 p-8 shadow-xl shadow-pink-100/60 backdrop-blur">
            <div class="mb-8 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-pink-500">Glamour Make</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-900">Bem-vindo(a)!</h1>
                <p class="mt-2 text-sm text-slate-500">Entre para gerenciar seu estoque.</p>
            </div>

            <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">E-mail</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="mail@example.com"
                        value="{{ old('email') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('email') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Senha</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="********"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('password') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        required
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex cursor-pointer items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                    Lembrar de mim
                </label>

                <button type="submit" class="w-full rounded-2xl bg-pink-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-200">
                    Entrar
                </button>
            </form>
        </div>
    </section>
@endsection