<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Color;
use App\Models\Brand;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // 1. Seedneme kategórie (voliteľné, ak chceš vlastné)
        $moznosti = ['Jarné', 'Letné', 'Jesenné', 'Zimné', 'Celoročné', 'Športové', 'Štýlové'];
        foreach ($moznosti as $option) {
            Season::create([
                'name' => $option,
                'description' => fake()->sentence(),
            ]);
        }


        Brand::factory()->count(30)->create();



        // 2. Seedneme dodávateľov
        Supplier::factory()
            ->count(5)
            ->create();

        $colors = [
            ['name' => 'Červená', 'sklon_name' => 'Červené', 'hex' => 'red'],
            ['name' => 'Modrá', 'sklon_name' => 'Modré', 'hex' => 'blue'],
            ['name' => 'Zelená', 'sklon_name' => 'Zelené', 'hex' => 'green'],
            ['name' => 'Oranžová', 'sklon_name' => 'Oranžové', 'hex' => 'orange'],
            ['name' => 'Fialová', 'sklon_name' => 'Fialové', 'hex' => 'purple'],
            ['name' => 'Biela', 'sklon_name' => 'Biele', 'hex' => 'white'],
            ['name' => 'Čierna', 'sklon_name' => 'Čierne', 'hex' => 'black'],
            ['name' => 'Viacfarebný', 'sklon_name' => 'Viacfarebné', 'hex' => 'linear-gradient(90deg, rgb(20, 190, 130) 0%, rgb(193, 255, 0) 33%, rgb(255, 85, 85) 67%, rgb(0, 92, 198) 100%)']
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }



        // 3. Seedneme produkty
        // Každý produkt dostane náhodne existujúce category_id a supplier_id
        Product::factory()
            ->count(100)
            ->create()
            ->each(function ($product) {
                // Generuj veľkosti pre každý produkt
                $velkosti = [5, 6, 7, 8, 9, 10, 11, 12];

                foreach ($velkosti as $size) {
                    ProductSize::create([
                        'product_id' => $product->id, // Prepojenie veľkosti s produktom
                        'us_velkost' => $size,         // Veľkosť
                        'pocet' => rand(0, 2),        // Náhodné množstvo od 0 do 2
                    ]);
                }
            });

    }
}
