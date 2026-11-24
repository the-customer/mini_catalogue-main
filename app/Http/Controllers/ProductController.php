<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $name = 'Product List';
        $products = config('catalog.products');
       return view('products.index', compact('products'));
        // return view('products.index', ['name' => 'Product List', 'Age' => 5]);
    }

    public function show(string $slug){
        $allproducts = config('catalog.products');
        $product = $allproducts->firstWhere('slug',$slug);

        abort_if(!$product,404);

        return view('products.show',compact('product'));
    }
}
