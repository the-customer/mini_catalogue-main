<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()

    {
        $products = collect(config('catalog.products'));
        # collect permet de transformer un tableau en collection, ce qui facilite la manipulation des données.
        $featuredProducts = $products->where('featured', true)->take(6)->values();
        
        return view('app' , [
            'products' => $featuredProducts
        ]);
    }
}
