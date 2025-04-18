<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showSablona() {
        return view('prihlasenie');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/profil');
        }

        return back()->withErrors([
            'email' => 'Nesprávne prihlasovacie údaje.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Odhlási používateľa
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regeneruje CSRF token

        return redirect('/'); // Presmeruje na domovskú stránku po odhlásení
    }


}
