<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;


Route::get('/', function () {
    return view('index');
});


Route::get('/zoznam-produktov', function () {
    return view('zoznam_produktov');
});


Route::get('/login', function () {
    return view('prihlasenie');
})->name('login');

Route::get('/register', function () {
    return view('registracia');
});

Route::get('/profil', function () {
    return view('profil');
})->name('profil');


Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

