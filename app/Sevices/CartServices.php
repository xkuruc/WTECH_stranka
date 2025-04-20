<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Vráti aktuálny košík (DB pre prihlásených, session pre neregistrovaných).
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(
                ['user_id'    => Auth::id()],
                ['session_id' => null]
            );
        }

        $sessionId = Session::getId();
        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id'    => null]
        );
    }
}
