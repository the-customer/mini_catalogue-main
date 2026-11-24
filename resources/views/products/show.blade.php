@extends('layouts.base')

@section('title',$product->slug)

@section('content')
<div class="grid" style="grid-template-columns: 1.2fr 1fr; align-items: start;">
    <div class="card">
        <img src="{{ $product->image }}" alt="{{ $product->image }}" style="width: 100%; height: 320px; object-fit: cover; border-radius: 12px;">
    </div>

    <div class="card">
        <h2 style="margin: 0">{{ $product->name }}</h2>
        <p class="muted" style="margin: 8px 0 0;">{{ $product->description }}</p>

        <div style="margin-top: 12px">
            <div><strong>Prix:</strong> {{ $product->price }} FCFA</div>
            <div><strong>Stock:</strong> {{ $product->stock }}</div>
        </div>

        <div class="row" style="margin-top: 14px; justify-content: space-between;">
            <a class="btn" href="{{ route('products.index') }}">Retour</a>
            <form method="POST" action="{{ route('cart.add',$product->id) }}">
                @csrf
                <button class="btn btn-primary" type="submit">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>
@endsection
