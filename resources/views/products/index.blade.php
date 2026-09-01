@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <section class="panel flex flex-row justify-between">
        <div class="panel__header">
            <div class="">
                <p> Cadastro de novos produtos no sistema</p>
            </div>
            <a class="button" href="{{ Route::has('products.edit') ? route('products.create') : '#' }}"> Novo Produto </a>
        </div>
    </section>

   {{-- Modal de edição --}}

<div
    id="editProductModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 px-4 py-8 backdrop-blur-sm"
>
    <div
        class="relative w-full max-w-xl min-h-[80vh] overflow-y-auto rounded-3xl border border-pink-100 bg-white shadow-2xl shadow-slate-900/20"
    >


    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between border-b border-slate-100 px-7 py-5">

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-pink-500">
                Produtos
            </p>

            <h2 class="mt-1 text-2xl font-bold text-slate-900">
                Editar produto
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Atualize as informações do produto.
            </p>
        </div>

        <button
            type="button"
            id="closeEditModal"
            class="flex h-10 w-10 items-center justify-center rounded-full text-xl text-slate-400 transition hover:bg-pink-50 hover:text-pink-500"
            aria-label="Fechar"
        >
            &times;
        </button>

    </div>


    {{-- Formulário --}}
    <form
        id="editProductForm"
        method="POST"
        enctype="multipart/form-data"
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
                Nome do produto
            </label>

            <input
                type="text"
                name="name"
                id="editName"
                required
                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:ring-4 focus:ring-pink-100"
                placeholder="Nome do produto"
            >
        </div>


        {{-- Descrição --}}
        <div>
            <label
                for="editDescription"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Descrição
            </label>

            <textarea
                name="description"
                id="editDescription"
                rows="4"
                required
                class="w-full resize-none rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:ring-4 focus:ring-pink-100"
                placeholder="Descrição do produto"
            ></textarea>
        </div>


        {{-- Preço --}}
        <div>
            <label
                for="editPrice"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Preço
            </label>

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                    R$
                </span>

                <input
                    type="number"
                    name="price"
                    id="editPrice"
                    step="0.01"
                    min="0"
                    required
                    class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition focus:border-pink-400 focus:ring-4 focus:ring-pink-100"
                    placeholder="0,00"
                >
            </div>
        </div>


        {{-- Imagem --}}
        <div>
            <label
                for="editImage"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Imagem do produto
            </label>

            <div
                class="rounded-2xl border border-dashed border-pink-200 bg-pink-50/50 p-4 transition hover:border-pink-400"
            >
                <div class="flex items-center gap-4">

                    {{-- Preview --}}
                    <div
                        id="editImagePreview"
                        class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white text-xs text-slate-400 shadow-sm"
                    >
                        Sem imagem
                    </div>

                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-700">
                            Alterar imagem
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            JPG, PNG ou WEBP. Escolha uma nova imagem se desejar.
                        </p>

                        <label
                            for="editImage"
                            class="mt-3 inline-flex cursor-pointer items-center rounded-xl bg-white px-3 py-2 text-xs font-semibold text-pink-600 shadow-sm ring-1 ring-pink-100 transition hover:bg-pink-50"
                        >
                            Escolher imagem
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="editImage"
                            accept="image/jpeg,image/png,image/webp"
                            class="hidden"
                        >
                    </div>

                </div>
            </div>
        </div>


        {{-- Ações --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

            <button
                type="button"
                id="cancelEdit"
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

{{-- Cards dos produtos --}}

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

@foreach ($products as $product)

    <div class="group relative">

        {{-- Botão de editar --}}
        <button
            type="button"
            class="edit-product absolute right-3 top-3 z-10 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full border border-white/70 bg-white/90 text-slate-500 shadow-md backdrop-blur-sm transition hover:scale-105 hover:bg-pink-500 hover:text-white"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-description="{{ $product->description }}"
            data-price="{{ $product->price }}"
            data-image="{{ $product->image }}"
            title="Editar produto"
        >
            ✎
        </button>


        {{-- Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-pink-100/60">

            {{-- Imagem --}}
            <div class="aspect-square overflow-hidden bg-slate-100">

                @if ($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                @else

                    <div class="flex h-full flex-col items-center justify-center text-slate-400">
                        <span class="text-3xl">📷</span>

                        <span class="mt-2 text-sm">
                            Sem imagem
                        </span>
                    </div>

                @endif

            </div>


            {{-- Informações --}}
            <div class="p-5">

                <h3 class="truncate text-lg font-bold text-slate-900">
                    {{ $product->name }}
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $product->category->name }}
                </p>


                {{-- Estoque --}}
                <div class="mt-5 flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">

                    <span class="text-sm font-medium text-slate-500">
                        Estoque
                    </span>

                    <span class="text-lg font-bold text-slate-900">
                        {{ $product->quantity }}
                    </span>

                </div>

            </div>

        </div>

    </div>

@endforeach

</div>



@endsection