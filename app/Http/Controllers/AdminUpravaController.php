<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
class AdminUpravaController
{
    public function showSablona($id)
    {

        $produkt = Product::find($id);
        $sizes_input = $produkt->productSizes->pluck('us_velkost')
            ->map(function ($size) {
                return intval($size); // Prevod na celé číslo
            })
            ->implode('; ');


        $sizes = [5, 6, 7, 8, 9, 10, 11, 12];
        $colors = Color::all();
        $brands = Brand::all();

        return view('admin_uprava', compact('sizes', 'colors', 'brands', 'produkt', 'sizes_input'));
    }

}


