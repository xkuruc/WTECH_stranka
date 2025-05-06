<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Brand;
use App\Models\Product;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    public function create_queries($query) {
        $pohlavia = ['Pánske', 'Dámske', 'Unisex'];
        $queries = [];

        foreach ($pohlavia as $pohlavia) {
            $pohlavie_query = (clone $query)->where('gender', $pohlavia);

            $pohlavie_brands = (clone $pohlavie_query)
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->distinct()
                ->select('brands.name', 'brands.display_name')
                ->orderBy('brands.display_name')
                ->limit(10)
                ->get();

            $queries[$pohlavia] = $pohlavie_brands;
        }

        /* latest produkty */
        $latest_products = (clone $query)->orderBy('created_at', 'desc')
        ->limit(10)
        ->get(['id', 'name']);


        $queries['latest'] = $latest_products;
        return $queries;
    }


    public function boot()
    {
        View::composer(['components.navbar', 'components.sidebar'], function ($view) {
            $query_tenisky = Product::query()->where('type', 'Tenisky');
            $query_kopacky = Product::query()->where('type', 'Kopacky');
            $query_lopty = Product::query()->where('type', 'Lopty');


            /* spravíme všetky queries, ktoré potrebujeme */
            $tenisky_pack = $this->create_queries($query_tenisky);
            $kopacky_pack = $this->create_queries($query_kopacky);
            $lopty_pack = $this->create_queries($query_lopty);


            /* dáme len 10 brandov pre každú kategóriu */
            $view->with([
                'tenisky_pack' => $tenisky_pack,
                'kopacky_pack' => $kopacky_pack,
                'lopty_pack' => $lopty_pack,
            ]);
        });
    }
}
