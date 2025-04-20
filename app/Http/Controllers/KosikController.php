<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class KosikController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $items = Auth::user()
                    ->cartItems()
                    ->with('product')
                    ->get();

        // voliteľne: získať shipping adresu
        $shipping = $user->address
                          ->firstWhere('address_type', 'shipping');

        return view('kosik', [
            'user'     => $user,
            'shipping' => $shipping,
            'items' => $items
        ]);
    }
}
