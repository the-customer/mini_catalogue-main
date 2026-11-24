 @props(['product'])
<div class="card">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100%; height:160px; object-fit:cover; border-radius:12px;">
            <div style="margin-top:10px;">
                <div class="row" style="justify-content:space-between;">
                <strong>{{ $product->name }}</strong>
                <span class="muted">{{ $product->price }} FCFA</span>
            </div>

            <p class="muted" style="margin:8px 0 12px;">
            {{ Str::limit($product->description, 100) }}
            </p>

    <div class="row" style="justify-content:space-between;">
      <a class="btn" href="{{ route('products.show',$product->slug) }}">Voir</a>

      <form method="POST" action="{{ route('cart.add',$product->id) }}">
        @csrf
        <button class="btn btn-primary" type="submit">Ajouter</button>
      </form>
    </div>
  </div>
</div>
