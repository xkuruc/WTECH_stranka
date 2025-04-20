<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    

    public function index()
    {
        $items = Auth::user()
                    ->cartItems()
                    ->with('product')
                    ->get();

        return view('cart.index', compact('items'));
    }

    /**
     * Pridá (alebo navýši) položku v košíku.
     * Ukladá product_id, size a quantity.
     * Vracia flash správu o úspechu/chybe.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'nullable|integer|min:1',
        'size'       => 'required|string',
    ]);

    // teraz bude $request->user() vždy objekt User
    $user = $request->user();
    $qty  = $data['quantity'] ?? 1;

    // položky sa kombinujú podľa user_id + product_id + size
    $item = CartItem::firstOrNew([
        'user_id'    => $user->user_id,
        'product_id' => $data['product_id'],
        'size'       => $data['size'],
    ]);

    $item->quantity = ($item->exists ? $item->quantity : 0) + $qty;
    $item->size     = $data['size'];

    $item->save();

    return redirect()
        ->back()
        ->with('success', "Pridané do košíka: {$item->product->name} (Veľkosť: {$item->size}, Množstvo: {$item->quantity}).");
}


    /**
     * Zmení množstvo existujúcej položky v košíku.
     */
    public function update(Request $request, CartItem $item)
    {
        // zabezpečíme, že item patrí prihlásenému používateľovi
        $this->authorize('update', $item);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->quantity = $data['quantity'];
        $item->save();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Množstvo položky v košíku bolo aktualizované.');
    }

    /**
     * Odstráni položku z košíka.
     */
    public function destroy(CartItem $item)
    {
        // zabezpečíme, že item patrí prihlásenému používateľovi
        $this->authorize('delete', $item);

        $item->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Položka bola odstránená z košíka.');
    }
}
