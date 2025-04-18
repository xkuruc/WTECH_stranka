<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class AdminDashboardController
{
    public function showSablona() {
        return view('admin_dash_login');
    }
    public function admin_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['visited_admin_dashboard' => true]); /* flag, že už sa počas session prihlásil do dashboardu, tak aby nemusel znova */

            return redirect()->intended('/admin_dashboard');
        }

        return back()->withErrors([
            'email' => 'Nesprávne prihlasovacie údaje.',
        ]);
    }

    public function admin_leave_dash(Request $request)
    {
        return redirect('/profil'); // Presmeruje na domovskú stránku po odhlásení
    }

    public function dashboard()
    {
        if (session('visited_admin_dashboard')) {
            $produkty = Product::all(); // alebo s paginate()
            return view('admin_dashboard', compact('produkty'));
        }
        else {
            return view('admin_dash_login');
        }
    }
}
