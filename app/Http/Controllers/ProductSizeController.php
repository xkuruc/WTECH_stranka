<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Zobrazí všetky veľkosti pre daný produkt.
     */
    public function index(Product $product)
    {
        $sizes = $product->productSizes()
                         ->orderBy('us_velkost')
                         ->get();

        return view('products.sizes.index', [
            'product' => $product,
            'sizes'   => $sizes,
        ]);
    }

    /**
     * Pridá novú US veľkosť k produktu.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'us_velkost' => 'required|string|max:10',
        ]);

        $product->productSizes()->create($validated);

        return redirect()
               ->back()
               ->with('success', 'Veľkosť úspešne pridaná.');
    }

    /**
     * Odstráni US veľkosť z produktu.
     */
    public function destroy(Product $product, ProductSize $productSize)
    {
        $productSize->delete();

        return redirect()
               ->back()
               ->with('success', 'Veľkosť úspešne odstránená.');
    }
}
