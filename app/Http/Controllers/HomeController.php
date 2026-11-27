<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()

    {
        $featured = Product::query()
            ->with('category')
            ->where('featured',true)
            ->orderBy('id')
            ->take(6)
            ->get();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('app',[
            'products' => $featured,
            'categories'=> $categories
        ]);
    }
}
