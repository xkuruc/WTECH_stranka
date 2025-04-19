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
        
        return view('zoznam_produktov', compact('products')); // Odovzdanie do nového view
    }

    public function show(Product $product)
    {
        // Eager‑load vzťahy, napr. galériu obrázkov
        // $product->load('images');
        $product->load(['images', 'category']);

        // Vrátime view 'polozka_produktu' s atribútom $product
        return view('polozka_produktu', compact('product'));
    }
}
