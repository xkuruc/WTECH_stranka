<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfilController
{
    public function showProfile()
    {
        $user = auth()->user()->load(['personalizacia', 'address']);

        return view('profil', compact('user'));
    }
}
