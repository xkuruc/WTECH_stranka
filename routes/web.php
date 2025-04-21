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
Route::get('/zoznam-produktov', [ProductController::class, 'index'])->name('products.index');
Route::get('/zoznam-produktov/cheapest', [ProductController::class, 'cheapest'])->name('products.cheapest');
Route::get('/zoznam-produktov/rich', [ProductController::class, 'rich'])->name('products.rich');
Route::get('/zoznam-produktov/latest', [ProductController::class, 'latest'])->name('products.latest');

Route::get('/polozka-produktu/{product}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('/polozka-produktu/{product}')->group(function(){
    Route::get('sizes',       [ProductSizeController::class, 'index'])
         ->name('products.sizes.index');

    Route::post('sizes',      [ProductSizeController::class, 'store'])
         ->name('products.sizes.store');

    Route::delete('sizes/{productSize}', [ProductSizeController::class, 'destroy'])
         ->name('products.sizes.destroy');
});


// Route::middleware(['auth'])->group(function () {
//     Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart',          [CartController::class, 'store'])->name('cart.store');
//     Route::put('/cart/{item}',    [CartController::class, 'update'])->name('cart.update');
//     Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
// });
Route::get('/cart',           [CartController::class, 'index'])->name('cart.index');
Route::post('/cart',          [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/{item}',    [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');


Route::post('/cart/{item}/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/{item}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');



Route::view('/kosik', 'kosik')->name('kosik');
Route::get('/kosik', [KosikController::class, 'index'])->name('kosik');

require base_path('routes/routes1.php');
require base_path('routes/routes2.php');
