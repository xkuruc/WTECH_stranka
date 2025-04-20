<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tento composer sa vykoná pri každom renderovaní komponentu kosik_sidebar
        View::composer('components.kosik_sidebar', function ($view) {
            $cartItems = Auth::check()
                ? Auth::user()->cartItems()->with('product')->get()
                : collect();

            $view->with('cartItems', $cartItems);
        });
    }
}
