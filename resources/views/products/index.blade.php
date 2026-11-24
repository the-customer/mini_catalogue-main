@extends('layouts.base')
@section('title', 'Product List')
@section('content')
<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">

    @forEach($products as $product)
       
     <x-product-card :product="$product" />  
    @endforEach
</div>
@endsection