<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\Supplier;
use App\Models\Season;
use App\Models\ProductSize;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function fill_filter($query) {
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



        /* dostupné sezóny pre produkty */
        $seasons = (clone $query)
            ->when(
                !collect($query->getQuery()->joins)->contains('table', 'seasons'),
                fn($q) => $q->join('seasons', 'products.season_id', '=', 'seasons.id')
            )
            ->select('seasons.name')
            ->distinct()
            ->pluck('seasons.name');


        /* pohlavie, zoberie sa rovno z products */
        $genders = (clone $query)
            ->distinct('gender')
            ->pluck('gender');


        /* dostupnosť, zoberie sa rovno z products */
        $available = (clone $query)
            ->distinct('available')
            ->pluck('available');



        return [$brands, $colors, $sizes, $seasons, $genders, $available];
    }


    public function order_products($request, $query) {
        /** ZORADENIE **/ /* funguje */

        /* url adresa requestu */
        $orderby = request()->getRequestUri();

        if (strpos($orderby, '&orderby=') !== false) { /* url obsahuje orderby */
            /* oddelí na &, dostaneme orderby=price... */
            $orderby = explode('&', $orderby)[1];

            /* ak je tam ? z ?page=.. , tak sa to zase oddelí, aby pstal čistý orderby */
            if (strpos($orderby, '?page') !== false) {
                $orderby = explode('?', $orderby)[0];
            }

            /* rozdelí to na 'orderby' => 'price...' */
            parse_str($orderby, $order_params);

            /* vyberieme obsah orderby */
            $orderby = $order_params['orderby'];
        }
        else {
            $orderby = 'price~asc'; /* default */
        }


        /* rozdelíme na menšie časti */
        $parts = explode('~', $orderby);
        $sortField = $parts[0] ?? 'price';
        $sortDirection = $parts[1] ?? 'asc';

        /* buď latest alebo podľa ceny */
        if ($sortField === 'latest') {
            $query->orderBy('created_at', 'desc');
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


        /* oddelíme orderby ak tam je, aby sme mali čisté filtre */
        $filters = explode('&', $filters)[0];



        /** HANDLOVANIE FILTROV AK SU **/
        [$query, $appliedFilters] = $this->handle_filters($request, $query, $filters);



        /** VYPLNENIE FILTRA **/
        [$brands, $colors, $sizes, $seasons, $genders, $available] = $this->fill_filter($query);



        /** ZORADENIE **/ /* funguje */
        $query = $this->order_products($request,$query);



        /** STRANKOVANIE **/
        $products = $query->paginate(12)->withQueryString();



        /** ZLAVNENE OBRAZKY **/
        $discountedImages = $products->where('discount', '>', 0)
            ->pluck('images')
            ->flatten()
            ->where('is_main', true);


        /* uložíme dáta do pola a posunieme buď do view alebo do search funkcie */
        $data = compact('products', 'discountedImages', 'type', 'brands', 'colors', 'sizes', 'seasons', 'genders', 'available', 'appliedFilters');
        return $isSearch ? $data : view('zoznam_produktov', $data); /* ak je to search, vráti len dáta, ináč vráti view */
    }



    public function search(Request $request)
    {
        /** SPRACOVANIE VSTUPU  **/
        $query = $request->query('query');


        /* rozdelenie url na query, ktoré sme si vyhľadali a na druhú časť - filtre */
        [$query, $filters] = explode('/', $query, 2) + [null, null];


        /* oddelí orderby ak tam je */
        $filters = explode('&', $filters)[0];


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
                    ->orWhereRaw("unaccent(gender) ILIKE unaccent(?)", ['%' . $word . '%']) /* pohlavie */
                    ->orWhereRaw("unaccent(type) ILIKE unaccent(?)", ['%' . $word . '%']) /* typ produktu */
                    ->orWhereHas('color', function ($colorQuery) use ($word) { /* farba */
                    $colorQuery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $word . '%'])
                        ->orWhereRaw("unaccent(sklon_name) ILIKE unaccent(?)", ['%' . $word . '%']);
                    })
                    ->orWhereHas('brand', function ($brandQuery) use ($word) { /* značku nájde aj name aj display_name */
                        $brandQuery->whereRaw("to_tsvector('simple', coalesce(brands.name, '') || ' ' || coalesce(brands.display_name, '')) @@ to_tsquery('simple', unaccent(?))", [$word])
                            ->orWhereRaw("unaccent(brands.name) ILIKE unaccent(?)", ['%' . $word . '%']);
                    })
                    ->orWhereHas('season', function ($seasonQuery) use ($word) { /* sezóna */
                        $seasonQuery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $word . '%']);
                    });
            });
        }


        /* aplikujeme filtre, pagination, získame obsah filtra a pod. */
        $data = $this->index($request, $type, $filters, $productsQuery, true);
        $data['query'] = $query; /* pridáme si vlastné query - čo si user vyhľadal */


        // Vrátime view s produktami a hľadaným textom
        return view('search_results', $data);
    }



    public function show(Product $product)
    {
        // Eager‑load vzťahy, napr. galériu obrázkov
        $product->load(['images', 'category', 'color', 'brand']);

        $discountedImages  = Product::with('images')->get()->where('discount', '>', 0)
            ->pluck('images')
            ->flatten()
            ->where('is_main', true);


        // Vrátime view 'polozka_produktu' s atribútom $product
        return view('polozka_produktu', compact('product', 'discountedImages'));
    }



    /*** ADMIN VECI - VYTVORENIE, MAZANIE, UPRAVA PRODUKTOV ***/
    /** VYTVORENIE **/
    public function create(Request $request)
    {
        // Validácia dát z formulára
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'gender' => 'required|string',
            'type' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'color_id' => 'required|exists:colors,id',
            'sizes' => 'required|string',
            'images.*' => 'required|image|max:2048',
            'image_types.*' => 'required|string',
            'base_name' => 'required|string',
        ]);


        $faker = Faker::create();


        $stock_quantity =  $faker->numberBetween(0, 100);
        $available_miesta = ['Bratislava', 'Praha','Košice', 'Skladom'];
        if ($stock_quantity == 0) {
            $available = 'Momentálne vypredané';
        } else {
            //ak je, tak si vyberie náhodne či je na sklade alebo na predajni
            $available = $faker->randomElement($available_miesta);
        }


        // Vytvorenie nového produktu
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'discount' => $validated['discount'],
            'SKU' => strtoupper($faker->bothify('???###')), /* SKU náhodné */
            'supplier_id' => $faker->randomElement(Supplier::pluck('id')->toArray()) ?? Supplier::factory(), /* dodávateľ */
            'stock_quantity' => $stock_quantity,
            'brand_id' => $validated['brand_id'],
            'available' => $validated['available'] ?? $available,
            'gender' => $validated['gender'],
            'color_id' => $validated['color_id'],
            'type' => $validated['type'],
            'season_id' => Season::inRandomOrder()->first()->id,
            'image_basename' => $validated['base_name'],
            'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
        ]);


        $base_name = $validated['base_name'];

        $dir = public_path('images/' . $base_name);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $storedPaths = [];


        if ($request->hasFile('images')) {
            $imageIndex = 0;
            if ($request->has('image_types')) {
                Log::debug('Image types:', $request->input('image_types'));  // Toto vypíše celé pole
            }
            foreach ($request->file('images') as $key => $image) {
                $imageType = $request->input('image_types')[$imageIndex];

                if ($image) {
                    $isMain = strpos($imageType, 'main') !== false; // Určujeme, či je hlavný obrázok

                    // Generovanie názvu súboru
                    $filename = $base_name . $imageType . '.' . $image->getClientOriginalExtension();


                    // Uloženie obrázku do priečinka 'public/images/base_name'
                    $image->move($dir, $filename);

                    // Uloženie cesty k obrázku
                    $storedPaths[$base_name] = $base_name . '/' . $filename;


                    // Uloženie obrázka do tabuľky `product_images`
                    $imageRecord = new ProductImage();
                    $imageRecord->product_id = $product->id; // ID nového produktu
                    $imageRecord->image_path = $storedPaths[$base_name]; // Cesta k obrázku
                    $imageRecord->is_main = $isMain; // Určujeme, či je hlavný obrázok
                    $imageRecord->save();

                    $imageIndex += 1;
                }
            }
        }
        else {
            return response()->json(['messaage' => 'nie su obrazky', 'images' => $validated['images'] ?? []]);
        }

        if (!empty($validated['sizes'])) {
            $sizes = explode(';', $validated['sizes']);

            foreach ($sizes as $size) {
                $trimmedSize = trim($size); // odstráni medzery

                ProductSize::create([
                    'product_id' => $product->id,
                    'us_velkost' => floatval($trimmedSize), // prevedie na číslo, napr. 5.0
                    'pocet' => rand(0, 50), // náhodne 0–50 kusov
                ]);
            }
        }


        return response()->json([
            'message' => 'Produkt úspešne vytvorený a obrázky nahrané.',
            'product' => $product,
            'paths' => $storedPaths,
        ]);
    }


    public function update(Request $request, $id) {

        $product = Product::findOrFail($id);



        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'gender' => 'required|string',
            'type' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'color_id' => 'required|exists:colors,id',
        ]);


        $validated2 = $request->validate([
            'images.*' => 'required|image|max:2048',
            'image_types.*' => 'required|string',
            'base_name' => 'required|string',
            'sizes' => 'required|string',
        ]);





        $product->update($validated);


        /* product sizes */
        if (!empty($validated2['sizes'])) {
            $product->sizes()->delete();

            $sizes = explode(';', $validated2['sizes']);
            foreach ($sizes as $size) {
                $trimmedSize = trim($size); // odstráni medzery

                ProductSize::create([
                    'product_id' => $product->id,
                    'us_velkost' => floatval($trimmedSize), // prevedie na číslo, napr. 5.0
                    'pocet' => rand(0, 50), // náhodne 0–50 kusov
                ]);
            }
        }



        $origin_images = $request->input('origin_images', []);
        $origin_images_trimmed = array_map(fn($url) => Str::after($url, 'images/'), $origin_images);

        $base_name = $product->image_basename;





        $directory = public_path("images/$base_name");

        $product->images()
            ->whereNotIn('image_path', $origin_images_trimmed)
            ->delete(); /* odstráni záznamy z db */



        if (File::exists($directory)) {
            $allFiles = File::files($directory);

            // Získať len názvy súborov z pôvodných ciest
            $allowedFiles = collect($origin_images)->map(function ($path) {
                return basename($path); // napr. 'product_123main.png'
            })->toArray();

            foreach ($allFiles as $file) {
                $filename = $file->getFilename();
                if (!in_array($filename, $allowedFiles)) {
                    File::delete($file->getPathname());
                }
            }



            $index = 0;
            $allFiles = File::files($directory); /* nový stav */
            /* test či sa nevymazal main image */
            $mainImage = $product->images()->where('is_main', true)->first();

            foreach ($allFiles as $file) {
                $filename = $file->getFilename();
                $old_filename = $base_name . '/' . $filename;
                $newFilename = '';


                Log::info("main image " .$mainImage);
                if ($index === 0) { /* nemá v názve main */
                    if (strpos($file->getFilename(), 'main') === false) {
                        $newFilename = "{$base_name}main.png";
                        $newFileRecord = $base_name . '/' . $newFilename;
                        $newFilePath = $directory . '/' . $newFilename;
                        File::move($file->getPathname(), $newFilePath);

                        $product->images()->where('image_path', $old_filename)->update(['image_path' => $newFileRecord]);
                    }
                    $index++;
                    continue;
                }


                $newFilename = "{$base_name}side{$index}.png";
                $newFilePath = $directory . '/' . $newFilename;
                $newFileRecord = $base_name . '/' . $newFilename;
                File::move($file->getPathname(), $newFilePath);


                // Aktualizujeme názov obrázku v databáze
                $product->images()->where('image_path', $old_filename)->update(['image_path' => $newFileRecord]);
                $index++;
            }



            if (!$mainImage) {
                // Ak neexistuje žiadny obrázok "main", priradíme prvý dostupný obrázok ako "main"
                $firstImage = $product->images()->first();

                if ($firstImage) {
                    $firstImage->update(['is_main' => true]);
                }
            }


        }
        else {
            File::makeDirectory($directory);
        }



        /* spracovanie obrázkov */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {

                $type = $request->input("image_types.$index") ?? "side$index";

                $filename = "{$base_name}{$type}." . $image->getClientOriginalExtension();
                $relativePath = "$base_name/$filename";
                $image->move(public_path("images/$base_name"), $filename);

                Log::info('Tu som baby: ' . $base_name . " " . $filename . $type);

                $product->images()->create([
                    'image_path' => $relativePath,
                    'is_main' => $type === 'main',
                ]);
            }
        }




        return redirect()->route('admin_dashboard')->with('success', 'Produkt bol úspešne upravený.');
    }


    public function destroy($id)
    {
        $produkt = Product::find($id);

        if (!$produkt) {
            return response()->json(['message' => 'Produkt nenájdený.'], 404);
        }

        $produkt->delete();

        return response()->json(['message' => 'Produkt bol úspešne zmazaný.']);
    }
}
