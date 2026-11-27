<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable','string','max:100'],
            'category' => ['string','max:100','nullable'],
            'page' => ['nullable','integer','min:1']
        ]);

        $q = trim($validated['q'] ?? '');
        $category = $validated['category'] ?? 'all';

        $query = Product::query()
            ->with('category');

            //filtrer par categorie
            if($category !== 'all'){
                $query->whereHas(
                    'category',
                    function(Builder $categoryQuery) use ($category){
                        $categoryQuery->where('slug',$category);
                    }
                );
            }
            //recherche
            if($q !== ''){
                $like = '%' . mb_strtolower($q) . '%';
                $query->where(function(Builder $searchQuery) use($like){
                    $searchQuery
                        ->where('name','like',$like)
                        ->orWhere('description','like',$like)
                        ->orWhereRaw(
                            'LOWER(CAST(tags AS CHAR)) LIKE ?',
                            [$like]
                        );
                });
            }


            //faire la requete et paginer
            $products = $query
                ->orderBy('id')
                ->paginate(12);


            $categories = Category::query()
                    ->orderBy('name')
                    ->get();

            return view('products.index',[
                'products'      => $products,
                'categories'    => $categories,
                'category'      => $category,
                'q'             => $q
            ]);
    }

    public function show(string $slug){
        $product = Product::query()
            ->with('category')
            ->where('slug',$slug)
            ->firstOrFail();


        return view('products.show',compact('product'));
    }
}
