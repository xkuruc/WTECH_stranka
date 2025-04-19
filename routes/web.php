<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('index');
});


Route::get('/zoznam-produktov', function () {
    return view('zoznam_produktov');
})->name('produkty.index');




Route::get('/register', function () {
    return view('registracia');
});


Route::get('/login', [LoginController::class, 'showSablona'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/profil', [ProfilController::class, 'showProfile'])->name('profil')->middleware('auth');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/zoznam-produktov', [ProductController::class, 'index'])
     ->name('products.index');

require base_path('routes/routes1.php');
require base_path('routes/routes2.php');
