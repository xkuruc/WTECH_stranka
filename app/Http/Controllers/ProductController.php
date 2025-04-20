<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Zobrazí stránkovaný zoznam produktov.
     */
    public function index()
    {
        //$products = Product::paginate(10);
        $products = Product::with('images')->paginate(10);
        $discountedImages  = $products->where('discount', '>', 0)
                                  ->pluck('images')
                                  ->flatten();
        
        
        return view('zoznam_produktov', compact('products')); // Odovzdanie do nového view
    }

    public function show(Product $product)
    {
        // Eager‑load vzťahy, napr. galériu obrázkov
        // $product->load('images');
        $product->load(['images', 'category']);

        $discountedImages  = Product::with('images')->get()->where('discount', '>', 0)
                                  ->pluck('images')
                                  ->flatten();
        // Vrátime view 'polozka_produktu' s atribútom $product
        return view('polozka_produktu', compact('product', 'discountedImages'));
    }
     // 2) nová – vzostupne podľa ceny
     public function cheapest()
     {
         $products = Product::orderBy('price', 'asc')->paginate(10);
         return view('zoznam_produktov', compact('products'));
     }
     public function rich()
     {
         $products = Product::orderBy('price', 'desc')->paginate(10);
         return view('zoznam_produktov', compact('products'));
     }
     public function latest()
     {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('zoznam_produktov', compact('products'));
     }

}
