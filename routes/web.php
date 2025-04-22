<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KosikController;

Route::get('/', function () {
    return view('index');
});



Route::get('/register', function () {
    return view('registracia');
});


Route::get('/login', [LoginController::class, 'showSablona'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/profil', [ProfilController::class, 'showProfile'])->name('profil')->middleware('auth');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');



Route::get('/polozka-produktu/{product}', [ProductController::class, 'show'])->name('products.show');



Route::prefix('/polozka-produktu/{product}')->group(function(){
    Route::get('sizes',       [ProductSizeController::class, 'index'])
         ->name('products.sizes.index');

    Route::post('sizes',      [ProductSizeController::class, 'store'])
         ->name('products.sizes.store');

    Route::delete('sizes/{productSize}', [ProductSizeController::class, 'destroy'])
         ->name('products.sizes.destroy');
});

Route::get('{type}/{filters?}', [ProductController::class, 'index'])
    ->where('type', 'Tenisky|Kopacky|Lopty|Vypredaj') // Restrict type to specific values
    ->where('filters', '.*')
    ->name('products.index');

Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
Route::post('/cart',          [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/{item}',    [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');


/* full text search */
Route::get('/search', [ProductController::class, 'search'])->name('search');



/* košík */
Route::post('/cart/{item}/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/{item}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

Route::post('/submit', [CartController::class, 'submit'])->name('cart.submit');

Route::view('/kosik', 'kosik')->name('kosik');
Route::get('/kosik', [KosikController::class, 'index'])->name('kosik');

require base_path('routes/routes1.php');
require base_path('routes/routes2.php');

