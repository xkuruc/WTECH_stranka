<?php

use Illuminate\Support\Facades\Route;

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
