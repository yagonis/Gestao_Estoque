@extends('layouts.app')

@section('title', 'Produtos')


@section('content')
    <div class="panel">
        <div>
            <form method="POST" action="{{ route('products.store') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nome do Produto</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Nome do Produto"
                        value="{{ old('name') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('name') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-slate-700">Descrição do Produto</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Descrição do Produto"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('description') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price" class="mb-2 block text-sm font-medium text-slate-700">Preço do Produto</label>
                    <input
                        id="price"
                        type="number"
                        name="price"
                        placeholder="Preço do Produto"
                        value="{{ old('price') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('price') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        min = "0.01"
                        step = "0.01"
                        required
                    >
                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quantity" class="mb-2 block text-sm font-medium text-slate-700">Quantidade do Produto</label>
                    <input
                        id="quantity"
                        type="number"
                        name="quantity"
                        placeholder="Quantidade do Produto"
                        value="{{ old('quantity') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('quantity') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        min = "0"
                        step = "1"
                        required
                    >
                    @error('quantity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category_id" class="mb-2 block text-sm font-medium text-slate-700">Categoria do Produto</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('category_id') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        required
                    >
                        <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="minimum_stock" class="mb-2 block text-sm font-medium text-slate-700">Estoque Mínimo do Produto</label>
                    <input
                        id="minimum_stock"
                        type="number"
                        name="minimum_stock"
                        placeholder="Estoque Mínimo do Produto"
                        value="{{ old('minimum_stock') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('minimum_stock') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                        min = "1"
                        step = "1"
                        required
                    >
                    @error('minimum_stock')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium text-slate-700">Imagem do Produto</label>
                    <input
                        id="image"
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100 @error('image') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                    >
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full rounded-2xl bg-pink-400 px-4 py-3 text-sm font-medium text-white transition hover:bg-pink-500 focus:outline-none focus:ring-4 focus:ring-pink-100">
                        Cadastrar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection