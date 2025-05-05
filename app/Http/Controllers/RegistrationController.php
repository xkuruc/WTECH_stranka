<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\Personalizacia;
use App\Models\Brand;

class RegistrationController extends Controller
{
    public function show() {

        $brands = Brand::all();

        return view('registracia', compact('brands'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'meno' => 'required',
            'priezvisko' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'telephone' => 'required',
            'ulica' => 'required',
            'cisloDomu' => 'required',
            'mesto' => 'required',
            'psc' => 'required',
            'krajina' => 'required',
        ]);

        // Vytvorenie používateľa
        $user = User::create([
            'meno' => $request->meno,
            'priezvisko' => $request->priezvisko,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'pohlavie' => $request->pohlavie ?? null,
            'datum_narodenia' => $request->datum_narodenia ?? null,
            'newsletter' => $request->has('newsletter'),
            'registration_date' => now(),
        ]);



        // Adresa
        $address = $user->address()->create([
            'address_type' => 'shipping',
            'ulica' => $request->ulica,
            'cisloDomu' => $request->cisloDomu,
            'mesto' => $request->mesto,
            'psc' => $request->psc,
            'krajina' => $request->krajina,
            'is_default' => true,
        ]);



        // Personalizácia
        if ($request->filled(['vyska', 'hmotnost', 'velkost_topanok', 'znacka'])) {
            $user->personalizacia()->create([
                'vyska' => $request->vyska,
                'hmotnost' => $request->hmotnost,
                'velkost_topanok' => $request->velkost_topanok,
                'znacka' => $request->znacka,
            ]);
        }


        return redirect()->route('login')->with('success', 'Účet bol úspešne vytvorený!');
    }

}
