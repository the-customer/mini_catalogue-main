@extends("layouts.base")

@section("title","Panier")

@section("content")

<div>
    <h4>Mon panier </h4>
    <form method="POST" action="{{ route('cart.clear') }}">
        @csrf
        <button class="btn">vider</button>
    </form>
    <ul>
        @foreach ($items as $item)
            <li>
                <form method="POST" action="{{ route('cart.changeQty',[$item->id,'down']) }}">
                    <button class="btn" id="plus">-</button>
                </form>
                    {{ $item->qty }}
                <form method="POST" action="{{ route('cart.changeQty',[$item->id,'up']) }}">
                    <button class="btn" id="plus">+</button>
                </form>

                    x {{ $item->name }} • {{ $item->price }} = {{ $item->subtotal }}
                <form method="POST" action="{{ route('cart.remove',$item->id) }}">
                    @csrf
                    <button class="btn">x</button>
                </form>

            </li>
        @endforeach
    </ul>
    <p>TOTAL : <strong>{{ $total }} FCFA</strong></p>
</div>
@endsection

