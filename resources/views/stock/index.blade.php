@extends('layouts.app')

@section('title', 'Estoque')

@section('content')
    <section class="panel">
        <div class="panel__header">
        </div>
            <br>

        <form method="POST" action="{{ route('stock.store') }}">
            @csrf
        <div id="MovementForm">
            <div>
                <select name="product_id" required>
                    <option value="">Selecione um produto</option>

                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                <label>
                    <input
                    type="radio"
                    name="type"
                    value="entry"
                    checked
                > Entrada
                </label>
                <label>
                    <input
                    type="radio"
                    name="type"
                    value="exit"
                > Saída
                </label>
            </div>
            <br>
            <div>
                <label for="quantity">Quantidade:</label>
                <input
                    type="number"
                    name="quantity"
                    placeholder="Ex: 15"
                    required
                    min="1"
                >
            </div>
            
                <br>

            <div>
                <button type="submit" class="button">Registrar</button>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </section>
@endsection