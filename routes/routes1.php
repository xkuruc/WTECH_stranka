<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPridanieProduktuController;


Route::get('/newsletter', [NewsletterController::class, 'edit'])->name('newsletter.edit');
Route::post('/newsletter/edit', [NewsletterController::class, 'update'])->name('newsletter.update');


/* admin dashboard */
Route::middleware(['auth', 'is_admin'])->get('/admin_dashboard', [App\Http\Controllers\AdminDashboardController::class, 'dashboard'])->name('admin_dashboard');

Route::get('/admin_dash_login', [AdminDashboardController::class, 'showSablona'])->name('admin_login_sablona');
Route::post('/admin_dash_login', [AdminDashboardController::class, 'admin_login'])->name('admin_login');

Route::post('/admin_dash_logout', [App\Http\Controllers\AdminDashboardController::class, 'admin_leave_dash'])->name('admin_leave_dash');



/* admin pridanie produktu */
Route::middleware(['auth', 'is_admin'])->get('/admin_add_product', [App\Http\Controllers\AdminPridanieProduktuController::class, 'showSablona'])->name('admin_pridanie_produktu');

