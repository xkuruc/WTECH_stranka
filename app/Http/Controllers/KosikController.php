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
        // Vždy získame aktuálnu session ID
        $sessionId = $request->session()->getId();
        // Pokúsi sa vrátiť prihláseného používateľa, ak neexistuje -> null
        $user = auth()->user();

        if ($user) {
            // prihlásený
            $items = $user
                ->cartItems()
                ->with('product')
                ->get();

            $shipping = $user
                ->address
                ->firstWhere('address_type', 'shipping');
        } else {
            // hosť
            $items = CartItem::with('product.images')
                ->where('session_id', $sessionId)
                ->get();

            $shipping = null;
        }

        return view('kosik', [
            'user'     => $user,
            'shipping' => $shipping,
            'items'    => $items,
        ]);
    }
}
