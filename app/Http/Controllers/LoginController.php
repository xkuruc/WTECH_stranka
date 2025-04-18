<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/';
    public function showSablona() {
        return view('prihlasenie');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Nesprávny email alebo heslo.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Odhlási používateľa
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regeneruje CSRF token

        return redirect('/'); // Presmeruje na domovskú stránku po odhlásení
    }

    protected function authenticated(Request $request, $user)
    {
        // Po prihlásení presmeruj na domovskú stránku alebo inú stránku podľa tvojej potreby
        return redirect()->route('/');  // Alebo iná route podľa tvojich potrieb
    }

}
