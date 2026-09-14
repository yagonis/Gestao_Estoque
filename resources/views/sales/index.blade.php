@extends('layouts.app')

@section('title', 'Vendas')

@php
    $products = \App\Models\Product::with('category')->get();
@endphp

@section('content')

@stack('scripts')

<div class="flex min-h-[calc(100vh-80px)]">

    {{-- ================= PRODUTOS ================= --}}
    <main class="w-2/3 overflow-y-auto p-6">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">
                Nova venda
            </h1>

            <form action="{{ route('sales.index') }}" method="GET" class="mt-4">
                <div class="flex max-w-xl rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">

                    <span>🔍</span>

                    <input
                        type="text"
                        name="search"
                        placeholder="Pesquisar produto..."
                        value="{{ request('search') }}"
                        class="ml-3 w-full outline-none"
                    >

                </div>
            </form>
        </div>


        {{-- GRID DE PRODUTOS --}}
        <div class="grid grid-cols-2 gap-5 lg:grid-cols-3 xl:grid-cols-4">

    @foreach ($products as $product)

    <div class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

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
        <div class="p-4">

            <h3 class="truncate text-lg font-bold text-slate-900">
                {{ $product->name }}
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                {{ $product->category->name }}
            </p>

            <div class="mt-3 flex items-center justify-between">

                <span class="text-lg font-bold text-pink-600">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </span>

                <span class="text-sm text-slate-500">
                    Estoque: {{ $product->quantity }}
                </span>

            </div>

            {{-- Botão adicionar --}}
            <button
                type="button"
                class="product-card mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-pink-600 py-3 font-semibold text-white transition hover:bg-pink-700"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ $product->price }}"
                data-stock="{{ $product->quantity }}"
                title="Adicionar ao carrinho"
            >
                <span class="text-xl">+</span>
                Adicionar
            </button>

        </div>

    </div>

@endforeach

        </div>

    </main>


    {{-- ================= CARRINHO ================= --}}
    <aside class="sticky top-0 flex h-screen w-1/3 flex-col bg-slate-800 p-6 text-white">

        <div class="mb-6">

            <h2 class="text-2xl font-bold">
                Carrinho
            </h2>

            <p class="text-sm text-slate-400">
                Produtos selecionados
            </p>

        </div>


        {{-- ITENS --}}
        <div
            id="cartItems"
            class="flex flex-1 flex-col gap-3 overflow-y-auto"
        >

            

        </div>


        {{-- TOTAL --}}
        <div class="mt-6 border-t border-slate-700 pt-5">

            <div class="flex items-center justify-between">

                <span class="text-slate-400">
                    Total
                </span>

                <span
                    id="cartTotal"
                    class="text-2xl font-bold"
                >
                    R$ 0,00
                </span>

            </div>

            <form id="saleForm" method="POST" action="{{ route('sales.store') }}">
            @csrf
            <input type="hidden" name="cart" id="cartInput">
            <button
                type="submit"
                id="finishSale"
                class="mt-5 w-full rounded-xl bg-pink-600 py-4 font-bold transition hover:bg-pink-700"
            >
                Finalizar venda
            </button>
            </form>

        </div>

    </aside>

</div>


@endsection


@push('scripts')

<script>

    const saleForm = document.getElementById('saleForm');
    const saleItems = document.getElementById('cartInput');

    saleForm.addEventListener('submmit', function(event) {
        if (cart.lenght === 0) {
            event.preventDefault();
            alert('O carrinho está vazio. Adicione produtos antes de finalizar a venda.');
            return;
        }
        saleItems.value = JSON.stringfy(
            cart.map(item => ({
                product_id: item.id,
                quantity: item.quantity
            }))
        );
    });

    const cart = [];


    const productCards = document.querySelectorAll('.product-card');
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');


    /*
    |--------------------------------------------------------------------------
    | Clicar em produto
    |--------------------------------------------------------------------------
    */

    productCards.forEach(card => {

        card.addEventListener('click', () => {

            const id = Number(card.dataset.id);
            const name = card.dataset.name;
            const price = Number(card.dataset.price);
            const stock = Number(card.dataset.stock);

            const existingProduct = cart.find(item => item.id === id);


            if (existingProduct) {

                if (existingProduct.quantity >= stock) {
                    alert('Quantidade máxima disponível em estoque.');
                    return;
                }

                existingProduct.quantity++;

            } else {

                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,
                    stock: stock
                });

            }

            renderCart();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Renderizar carrinho
    |--------------------------------------------------------------------------
    */

    function renderCart()
    {
        cartItems.innerHTML = '';

        let total = 0;


        if (cart.length === 0) {

            cartItems.innerHTML = `
                <div class="flex flex-1 items-center justify-center text-center">

                    <div>
                        <div class="text-4xl">🛒</div>

                        <p class="mt-3 text-slate-400">
                            O carrinho está vazio
                        </p>

                        <p class="text-sm text-slate-500">
                            Clique em um produto para adicioná-lo
                        </p>
                    </div>

                </div>
            `;

            cartTotal.textContent = 'R$ 0,00';

            return;
        }


        cart.forEach((item, index) => {

            const subtotal = item.price * item.quantity;

            total += subtotal;


            const element = document.createElement('div');

            element.className =
                'rounded-2xl bg-slate-700 p-4';


            element.innerHTML = `

                <div class="flex items-start justify-between">

                    <div class="min-w-0">

                        <h3 class="truncate font-semibold">
                            ${item.name}
                        </h3>

                        <p class="mt-1 text-sm text-slate-400">
                            R$ ${formatPrice(item.price)} cada
                        </p>

                    </div>


                    <button
                        type="button"
                        onclick="removeItem(${index})"
                        class="ml-3 text-slate-400 hover:text-red-400"
                    >
                        ✕
                    </button>

                </div>


                <div class="mt-4 flex items-center justify-between">

                    <div class="flex items-center gap-2">

                        <button
                            type="button"
                            onclick="decreaseQuantity(${index})"
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-600 hover:bg-slate-500"
                        >
                            −
                        </button>


                        <span class="w-6 text-center">
                            ${item.quantity}
                        </span>


                        <button
                            type="button"
                            onclick="increaseQuantity(${index})"
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-600 hover:bg-slate-500"
                        >
                            +
                        </button>

                    </div>


                    <span class="font-bold">
                        R$ ${formatPrice(subtotal)}
                    </span>

                </div>

            `;


            cartItems.appendChild(element);

        });


        cartTotal.textContent = `R$ ${formatPrice(total)}`;
    }


    /*
    |--------------------------------------------------------------------------
    | Aumentar quantidade
    |--------------------------------------------------------------------------
    */

    function increaseQuantity(index)
    {
        const item = cart[index];

        if (item.quantity >= item.stock) {

            alert('Quantidade máxima disponível em estoque.');

            return;
        }

        item.quantity++;

        renderCart();
    }


    /*
    |--------------------------------------------------------------------------
    | Diminuir quantidade
    |--------------------------------------------------------------------------
    */

    function decreaseQuantity(index)
    {
        const item = cart[index];

        item.quantity--;

        if (item.quantity <= 0) {

            cart.splice(index, 1);

        }

        renderCart();
    }


    /*
    |--------------------------------------------------------------------------
    | Remover produto
    |--------------------------------------------------------------------------
    */

    function removeItem(index)
    {
        cart.splice(index, 1);

        renderCart();
    }


    /*
    |--------------------------------------------------------------------------
    | Formatação de preço
    |--------------------------------------------------------------------------
    */

    function formatPrice(value)
    {
        return value.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }


    renderCart();

</script>

@endpush