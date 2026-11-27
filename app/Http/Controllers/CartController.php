<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;





class CartController extends Controller
{
    function index(Request $request){
        $cart = session('cart',[]); // [id => qty]
        $products = Product::query()
            ->whereIn('id',array_keys($cart))
            ->get()
            ->keyBy('id');
        $items = collect();
        $cleanCart = [];

        foreach ($cart as $id => $quantity) {
            $product = $products->get((int)$id);
            $quantity = (int) $quantity;

            if(!$product || $quantity < 1){
                continue;
            }

            $cleanCart[$product->id] = $quantity;

            $items->push((object)[
                'id'        => $product->id,
                'name'      => $product->name,
                'price'     => $product->price,
                'image'     => $product->image,
                'qty'       => $product->quantity,
                'subtotal'  => $product->price * $quantity
            ]);
        }

        $request->session()->put('cart',$cleanCart);

        $total = $items->sum('subtotal');

        return view("cart.index",compact('total','items'));
    }
    public function add(int $id){
        $product = $this->findProductById($id);
        abort_if(!$product,404);

        $cart = session('cart',[]);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        // $cart[$id] = ($cart[$id] ? 0 : $cart[$id]) + 1;

        session(['cart' => $cart]);

        return back()->with('success',"$product->name ajoute au panier");

     }

    public function remove(int $id){
        $cart = session('cart',[]);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success','Produit retire du panier');
    }

    public function clear(){
        session()->forget('cart');
        return back()->with('success','Panier vide');
    }

    public function increment(int $id){
        $cart = session('cart',[]);
        $cart[$id] = $cart[$id] + 1;
        session(['cart' => $cart]);
        return back()->with('success','Produit ajouté avec succès');
    }

    public function decrement(int $id){
        $cart = session('cart',[]);
        $cart[$id] = $cart[$id] - 1;
        session(['cart' => $cart]);
        return back()->with('success','Produit retire avec succès');
    }

    public function changeQty(int $id, string $sens){
        $cart = session('cart',[]);
        $cart[$id] = $sens === "up" ? $cart[$id] + 1 : ($cart[$id] <= 1 ? 1 : $cart[$id] - 1);
        session(['cart' => $cart]);
        $message = $sens === "up" ? 'Produit ajoute avec succès' : 'Produit retire avec succès';
        return back()->with('success',$message);
    }

    private function findProductById(int $id){
        return config('catalog.products')->firstWhere('id',$id);
    }
}
