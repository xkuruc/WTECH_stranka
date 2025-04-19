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
        #$products = Product::paginate(10);
        $products = Product::all();
        return view('zoznam_produktov', compact('products')); // Odovzdanie do nového view
    }
}
