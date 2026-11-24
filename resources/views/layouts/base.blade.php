<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Mini Boutique')</title>
  <style>
    body { font-family: ui-sans-serif, system-ui; margin:0; background:#f6f7fb; }
    .container { max-width: 1100px; margin: 0 auto; padding: 16px; }
    .card { background:#fff; border:1px solid #e6e8ef; border-radius:14px; padding:14px; }
    .btn { display:inline-block; padding:10px 12px; border-radius:10px; border:1px solid #d7dbe7; background:#fff; cursor:pointer; text-decoration:none; }
    .btn-primary { background:#111827; color:#fff; border-color:#111827; }
    .grid { display:grid; gap:14px; }
    .grid-3 { grid-template-columns: repeat(3, minmax(0,1fr)); }
    @media (max-width: 900px){ .grid-3{ grid-template-columns: repeat(2, minmax(0,1fr)); } }
    @media (max-width: 600px){ .grid-3{ grid-template-columns: 1fr; } }
    input, select { padding:10px 12px; border-radius:10px; border:1px solid #d7dbe7; width:100%; }
    .nav { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:14px 16px; background:#fff; border-bottom:1px solid #e6e8ef; }
    .nav a { text-decoration:none; color:#111827; font-weight:600; }
    .muted { color:#6b7280; }
    .row { display:flex; gap:12px; align-items:center; }
    .title { margin:0; font-size: 22px; }
  </style>
</head>
<body>
  <div class="nav">
    <div class="row">
      <a href="{{ route('home.index') }}">Mini Boutique</a>
      <span class="muted">|</span>
      <a href="{{ route('products.index') }}">Produits</a>
    </div>

    <div class="row">
      <a href="{{ route('cart.index') }}">
        {{-- Panier ({{ count(collect(session('cart',[]))) }}) --}}
        Panier ({{ collect(session('cart',[]))->sum() }})
      </a>
    </div>
  </div>

  <div class="container">
    {{-- Ici affichage des message flash --}}
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    @yield('content')
  </div>
</body>
</html>
