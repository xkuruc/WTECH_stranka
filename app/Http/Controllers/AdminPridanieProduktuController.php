<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Color;


class AdminPridanieProduktuController
{
    public function showSablona()
    {
        $sizes = [5, 6, 7, 8, 9, 10, 11, 12];
        $colors = Color::all();
        $brands = Brand::all();

        return view('admin_pridanie_polozky', compact('sizes', 'colors', 'brands'));
    }

}
