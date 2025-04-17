<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/zoznam-produktov', function () {
    return view('zoznam_produktov');
});

