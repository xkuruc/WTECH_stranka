<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;


class ProductController extends Controller
{

    public function fill_filter($query,$type) {
        /* na základe products vyplní filter */
        /** UDAJE DO VELKEHO FILTRA **/
        /* značky pre tie produkty */


        $brands = (clone $query)
            ->when(!collect($query->getQuery()->joins)->contains('table', 'brands'),
                fn($q) => $q->join('brands', 'products.brand_id', '=', 'brands.id')
            )
            ->distinct()
            ->select('brands.name', 'brands.display_name')
            ->orderBy('brands.display_name')
            ->get();


        /* farby pre tie produkty */
        $colors = (clone $query)
            ->when(!collect($query->getQuery()->joins)->contains('table', 'colors'),
                fn($q) => $q->join('colors', 'products.color_id', '=', 'colors.id')
            )
            ->distinct('colors.name') /* len unikátne farby */
            ->select('colors.name', 'colors.hex')
            ->get();


        /* zoradenie farieb */
        $colors = $colors->sortBy(function($color) {
            return strpos($color->name, 'Viacfarebný') === false ? 0 : 1;
        });


        /* velkosti pre tie produkty */
        $sizes = (clone $query)
            ->when(!collect($query->getQuery()->joins)->contains('table', 'product_sizes'),
                fn($q) => $q->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
            )
            ->where('product_sizes.pocet', '>', 0)
            ->select('product_sizes.us_velkost')
            ->distinct() /* len unikátne */
            ->orderBy('product_sizes.us_velkost') /* zoradí podľa veľkosti */
            ->pluck('product_sizes.us_velkost');


        return [$brands, $colors, $sizes];
    }


    public function order_products($request, $query) {
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

        return $query;
    }



    public function handle_filters(Request $request, $query, $filters = null) {
        $appliedFilters = [];

        /** HANDLOVANIE FILTRA **/
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

                    case 'size': /* treba to spojiť s product_sizes aby sme zistili čo je dostupné */ /* funguje */
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

        return [$query, $appliedFilters];
    }









    /**
     * Zobrazí stránkovaný zoznam produktov.
     */
    public function index(Request $request, $type, $filters = null, $query = null, $isSearch = false)
    {
        /*** QUERY HANDLING ***/
        $query = $query ?? Product::with('images');



        /** TYP PRODUKTU - Tenisky, Topanky, Lopty,.. **/
        if ($type) {
            if ($type === 'Vypredaj') {
                $query->where('discount', '>', 0);
            } else {
                $query->where('type', $type);
            }
        }




        /** HANDLOVANIE FILTROV AK SU **/
        [$query, $appliedFilters] = $this->handle_filters($request, $query, $filters);



        /** VYPLNENIE FILTRA **/
        [$brands, $colors, $sizes] = $this->fill_filter($query, $type);



        /** ZORADENIE **/ /* funguje */
        $query = $this->order_products($request,$query);



        /** STRANKOVANIE **/
        $products = $query->paginate(12)->withQueryString();



        /** ZLAVNENE OBRAZKY **/
        $discountedImages = $products->where('discount', '>', 0)
            ->pluck('images')
            ->flatten();


        /* uložíme dáta do pola a posunieme buď do view alebo do search funkcie */
        $data = compact('products', 'discountedImages', 'type', 'brands', 'colors', 'sizes', 'appliedFilters');
        return $isSearch ? $data : view('zoznam_produktov', $data); /* ak je to search, vráti len dáta, ináč vráti view */
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








    public function search(Request $request)
    {
        /** SPRACOVANIE VSTUPU  **/
        $query = $request->query('query');


        /* rozdelenie url na query, ktoré sme si vyhľadali a na druhú časť - filtre */
        [$query, $filters] = explode('/', $query, 2) + [null, null];


        /* oddelí orderby ak tam je */
        $filters = explode('?', $filters)[0];


        /* odstránime čiarky a rozdelíme vstup tam, kde sú medzery napr. "pánske lopty" -> ["pánske","lopty"]*/
        $query = str_replace(',', '', $query);
        $words = explode(' ', $query);
        $type = null;


        /* query builder */
        $productsQuery = Product::query();


        /* pre každé slovo zistíme, či nepatrí do nejakej kategórie a výsledky spojíme cez AND */
        foreach ($words as $word) {
            if (Product::where('type', 'ILIKE', '%' . $word . '%')->exists()) {
                $type = ucwords(strtolower($word));;

            }


            /* prehľadávame či slovo nepatrí do nejakej kategórie */
            $productsQuery->where(function($q) use ($word) {
                $word = strtolower($word);

                $q->whereRaw("to_tsvector('simple', coalesce(products.name, '') || ' ' || coalesce(products.description, '')) @@ to_tsquery('simple', unaccent(?))", [$word]) /* názov, popis produktu */
                    ->orWhereRaw("unaccent(gender) ILIKE ?", ['%' . $word . '%']) /* pohlavie */
                    ->orWhereRaw("unaccent(type) ILIKE ?", ['%' . $word . '%']) /* typ produktu */
                    ->orWhereHas('color', function ($colorQuery) use ($word) { /* farba */
                    $colorQuery->whereRaw("unaccent(name) ILIKE ?", ['%' . $word . '%'])
                        ->orWhereRaw("unaccent(sklon_name) ILIKE ?", ['%' . $word . '%']);
                    })
                    ->orWhereHas('brand', function ($brandQuery) use ($word) { /* značku nájde aj name aj display_name */
                        $brandQuery->whereRaw("to_tsvector('simple', coalesce(brands.name, '') || ' ' || coalesce(brands.display_name, '')) @@ to_tsquery('simple', unaccent(?))", [$word])
                            ->orWhereRaw("unaccent(brands.name) ILIKE ?", ['%' . $word . '%']);
                    })
                    ->orWhereHas('season', function ($seasonQuery) use ($word) { /* sezóna */
                        $seasonQuery->whereRaw("unaccent(name) ILIKE ?", ['%' . $word . '%']);
                    });
            });
        }


        /* aplikujeme filtre, pagination, získame obsah filtra a pod. */
        $data = $this->index($request, $type, $filters, $productsQuery, true);
        $data['query'] = $query; /* pridáme si vlastné query - čo si user vyhľadal */


        // Vrátime view s produktami a hľadaným textom
        return view('search_results', $data);
    }
}
