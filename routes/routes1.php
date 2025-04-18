<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;


Route::get('/newsletter', [NewsletterController::class, 'edit'])->name('newsletter.edit');
Route::post('/newsletter/edit', [NewsletterController::class, 'update'])->name('newsletter.update');
