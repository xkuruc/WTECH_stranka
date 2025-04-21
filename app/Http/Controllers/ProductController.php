<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;


class ProductController extends Controller
{
    /**
     * Zobrazí stránkovaný zoznam produktov.
     */
    public function index(Request $request, $type, $filters = null)
    {
        /*** QUERY HANDLING ***/
        $query = Product::with('images');
        $appliedFilters = [];

        /** TYP PRODUKTU - Tenisky, Topanky, Lopty,.. **/
        $type = $type ?? 'Tenisky'; // Default to 'Tenisky' if not provided
        if ($type === 'Vypredaj') {
            $query->where('discount', '>', 0);
        } else {
            $query->where('type', $type);
        }


        /** FILTER **/
        /* filter má tvar: {typ_produktu}/{ {znacka}_{velkost}_{farba}_{dostupnost}_{cena}_{zlava}_{pohlavie}_{sezona} }?orderby={zoradenie}, */
        /* medzi atribútmi v rámci kategórie sú - napr. znacka: adidas-nike-puma */
        if ($filters) {
            /* rozdelí na kategórie */
            $filterParts = explode('_', $filters);

            /* spracuje každú časť zvlášť */
            foreach ($filterParts as $part) {
                /* rozdelí na znacka (key): .-.-. (value) a spracuje druhú časť */
                [$key, $value] = explode('-', $part, 2);
                $values = explode('-', $value);

                /* zase ho poskladáme */
                if ($key != 'sale') {
                    $appliedFilters[$key] = $values;
                }

                /* čo je to za kategóriu */
                /* whereIn robí SQL ako "WHERE IN (values)" čiže ak je tam aspon jedna z nich */
                switch ($key) {
                    case 'brand': /* funguje */
                        $query->join('brands', 'products.brand_id', '=', 'brands.id')
                        ->whereIn('brands.name', $values)
                        ->select('products.*');
                        break;

                    case 'size': /* treba to spojiť s product_sizes aby sme zistil ičo je dostupné */ /* funguje */
                        $query->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')
                            ->whereIn('product_sizes.us_velkost', $values)
                            ->where('product_sizes.pocet', '>', 0)
                            ->select('products.*');
                        break;
                    case 'color': /* funguje */
                        $query->join('colors', 'products.color_id', '=', 'colors.id')
                            ->whereIn('colors.name', $values)
                            ->select('products.*');
                        break;
                    case 'available': /* funguje */
                        $query->whereIn('available', $values);
                        break;
                    case 'price': /* funguje */
                        /* cena medzi min a max už po zlave */
                        $query->whereRaw('(price * (1 - discount / 100)) BETWEEN ? AND ?', [$values[0], $values[1]]);
                        break;
                    case 'sale': /* funguje */
                        $minSale = null;
                        $maxSale = null;
                        foreach ($values as $salePart) {
                            if (str_starts_with($salePart, 'od')) {
                                $minSale = (int) substr($salePart, 2);
                            } elseif (str_starts_with($salePart, 'do')) {
                                $maxSale = (int) substr($salePart, 2);
                            }
                        }

                        if ($minSale !== null) {
                            $appliedFilters['sale']['od'] = $minSale;
                            $query->where('discount', '>=', $minSale);
                        }
                        if ($maxSale !== null) {
                            $appliedFilters['sale']['do'] = $maxSale;
                            $query->where('discount', '<=', $maxSale);
                        }
                        break;
                    case 'gender': /* funguje */
                        $query->whereIn('gender', $values);
                        break;
                    case 'season': /* funguje */
                        $query->join('seasons', 'seasons.id', '=', 'products.season_id')
                            ->whereIn('seasons.name', $values)
                            ->select('products.*');
                        break;
                }
            }
        }



        /** ZORADENIE **/ /* funguje */
        $orderby = $request->query('orderby', 'price~asc'); // Default to price ascending

        /* rozdelíme na menšie časti */
        $parts = explode('~', $orderby);
        $sortField = $parts[0] ?? 'price';
        $sortDirection = $parts[1] ?? 'asc';

        /* buď latest alebo podľa ceny */
        if ($sortField === 'latest') {
            $query->orderBy('created_at', 'desc'); // Same as latest()
        } else {
            $query->orderByRaw('(price * (1 - discount / 100)) ' . $sortDirection); // price~asc or price~desc
        }


        /** STRANKOVANIE **/
        $products = $query->paginate(12)->withQueryString();


        /** UDAJE DO VELKEHO FILTRA **/
        /* značky pre ten typ produktu */
        $brands = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->when($type && $type !== 'Vypredaj', function ($query) use ($type) {
                return $query->where('products.type', $type);
            })
            ->when($type === 'Vypredaj', function ($query) {
                return $query->where('products.discount', '>', 0);
            })
            ->distinct()
            ->select('brands.name', 'brands.display_name')
            ->orderBy('brands.display_name')
            ->get();


        /* farby pre ten typ produktu */
        $colors = Product::join('colors', 'products.color_id', '=', 'colors.id')
            ->when($type && $type !== 'Vypredaj', function ($query) use ($type) {
                return $query->where('products.type', $type);
            })
            ->when($type === 'Vypredaj', function ($query) {
                return $query->where('products.discount', '>', 0);  // Filtruj len produkty s discount > 0, ak je type "Vypredaj"
            })
            ->distinct()
            ->distinct('colors.name') /* len unikátne farby */
            ->select('colors.name', 'colors.hex')
            ->get();


        /* zoradenie farieb */
        $colors = $colors->sortBy(function($color) {
            return strpos($color->name, 'Viacfarebný') === false ? 0 : 1;
        });


        /* velkosti pre ten typ produktu */
        $sizes = \DB::table('product_sizes')
            ->join('products', 'products.id', '=', 'product_sizes.product_id')
            ->when($type && $type !== 'Vypredaj', function ($query) use ($type) {
                return $query->where('products.type', $type);
            })
            ->when($type === 'Vypredaj', function ($query) {
                return $query->where('products.discount', '>', 0);  // Filtruj len produkty s discount > 0, ak je type "Vypredaj"
            })
            ->where('product_sizes.pocet', '>', 0)
            ->distinct() /* len unikátne */
            ->orderBy('product_sizes.us_velkost') /* zoradí podľa veľkosti */
            ->pluck('product_sizes.us_velkost');




        /** ZLAVNENE OBRAZKY **/
        $discountedImages = $products->where('discount', '>', 0)
            ->pluck('images')
            ->flatten();


        return view('zoznam_produktov', compact('products', 'discountedImages', 'type', 'brands', 'colors', 'sizes', 'appliedFilters'));
    }

    public function show(Product $product)
    {
        // Eager‑load vzťahy, napr. galériu obrázkov
        $product->load(['images', 'category', 'color', 'brand']);

        $discountedImages  = Product::with('images')->get()->where('discount', '>', 0)
                                  ->pluck('images')
                                  ->flatten();


        // Vrátime view 'polozka_produktu' s atribútom $product
        return view('polozka_produktu', compact('product', 'discountedImages'));
    }


    /* todo
    - opraviť cesty k tým typom
    - nastaviť výpredaj cestu
    - uložiť filter ked sa zapne query
    - vyplnit filter dynamicky
    */


}
