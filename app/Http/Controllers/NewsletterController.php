<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function edit()
    {
        // Získame aktuálneho prihláseného používateľa
        $user = Auth::user();  // Alebo auth()->user(), ak preferuješ tento spôsob
        return view('newsletter_sablona', compact('user'));  // Odovzdáme používateľa do šablóny
    }

    // Spracovanie úpravy newsletteru
    public function update(Request $request)
    {
        // Získame aktuálneho prihláseného používateľa
        $user = Auth::user();

        // Nastavíme stav prihlásenia na newsletter podľa checkboxu
        // Ak je checkbox zaškrtnutý, prihlásime používateľa (nastavíme true), inak ho odhlásime (nastavíme false)
        $user->newsletter = $request->has('newsletter');  // Ak je 'newsletter' v požiadavke, nastavíme true
        $user->save();  // Uložíme zmeny do databázy

        // Presmerujeme späť na profil s úspešnou správou
        return redirect()->route('profil')->with('status', 'Vaše nastavenia newsletteru boli úspešne aktualizované.');
    }

}
