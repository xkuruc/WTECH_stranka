<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UserOrder;

class CartController extends Controller
{
//     public function index()
// {
//     $query = CartItem::with('product');
    
//     if ( auth()->id() === null ) {
//         $query->where('session_id', session()->getId());
        
//     } else {
        
//         $query->where('user_id', Auth::id())
//               ->orWhere('session_id', session()->getId());
//     }

//     $items = $query->get();

//     return view('cart.index', compact('items'));
// }
public function index()
{
    $sessionId = session()->getId();

    $items = CartItem::with('product')
        ->when(
            auth()->check(),
            // ak je prihlásený
            function ($query) use ($sessionId) {
                $userId = auth()->id();
                // zoskupíme OR podmienky do jednej zátvorky
                $query->where(function ($q) use ($userId, $sessionId) {
                    $q->where('user_id', $userId)
                      ->orWhere('session_id', $sessionId);
                });
            },
            // ak nie je prihlásený
            function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
            }
        )
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
    // 1. Validácia vstupu
    $data = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'nullable|integer|min:1',
        'size'       => 'required|string',
    ]);

    // 2. Zisti, či je používateľ prihlásený, inak použij session ID
    $user      = $request->user();               // null, ak hosť
    $sessionId = $request->session()->getId();

    $ownerKey   = $user ? 'user_id' : 'session_id';
    $ownerValue = $user ? $user->user_id : $sessionId;

    $qty = $data['quantity'] ?? 1;

    // 3. Nájde existujúcu alebo vytvorí novú položku podľa vlastníka + produktu + veľkosti
    $item = CartItem::firstOrNew([
        'product_id' => $data['product_id'],
        'size'       => $data['size'],
        $ownerKey    => $ownerValue,
    ]);
    if ($item->exists) {
        $item->quantity += $qty;// ak už je v košíku, pridáme k existujúcemu množstvu
    } else {
        $item->quantity = $qty; // ak je novo vytvorený, nastavíme množstvo
    }

    if ($user) {
        $item->user_id    = $user->user_id;
        $item->session_id = null;
    } else {
        $item->user_id    = null;
        $item->session_id = $sessionId;
    }
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
    public function increment(CartItem $item)
    {
        $item->quantity++;
        $item->save();

        return back()->with('toggle_sidebar', true);
    }

    public function decrement(CartItem $item)
    {
        if ($item->quantity > 1) {
            $item->quantity--;
            $item->save();
        } else {
            // ak je množstvo 1 a klikneš –, položku úplne vymaž
            $item->delete();
        }

        return back()->with('toggle_sidebar', true);
    }
    public function submit(Request $request)
    {
        // $data = $request->validate([
        //     'meno'     => 'required|string|max:255',
        //     'email'    => 'required|email',
        // ]);

        $sessionId = $request->session()->getId();

        if (auth()->check()) {
            // Nacítam vsetky polozky z kosika
            $items    = CartItem::where('user_id', auth()->id())->get();
            $userId   = auth()->id();
        
            //Spocítame total cenu
            $totalPrice = $items->sum(function($item) {
                $qty   = $item->quantity ?? 1;
                $price = $item->product->price ?? 0;
                return $price * $qty;
            });
            // Vytvorime  zaznam v user_orders
            UserOrder::create([
                'user_id'    => $userId,
                'price'      => $totalPrice,
                'status'     => 'pending',       // alebo iný default
                'created_at' => now(),
            ]);
            // prihlaseny pouzivatel – vymaze jeho vsetky polozky
            CartItem::where('user_id', auth()->id())->delete();
        } else {
            // host – vymaze vsetko viazana na session_id
            CartItem::where('session_id', $sessionId)->delete();
        }
        

        // 3) Redirect so uspesnou spravou
        // return redirect('/')->with('success', 'Všetko prebehlo v poriadku!');
        return redirect()
           ->route('cart.finalize')->with('success', 'Všetko prebehlo v poriadku!');
    }
    public function finalize()
    {
        return view('finalize');
    }
}
