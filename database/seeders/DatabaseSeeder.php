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
        Season::factory()
            ->count(5)
            ->create();

        // 2. Seedneme dodávateľov (voliteľné)
        Supplier::factory()
            ->count(5)
            ->create();

        $colors = [
            ['name' => 'Červená', 'hex' => 'red'],
            ['name' => 'Modrá', 'hex' => 'blue'],
            ['name' => 'Zelená', 'hex' => 'green'],
            ['name' => 'Oranžová', 'hex' => 'orange'],
            ['name' => 'Fialová', 'hex' => 'purple'],
            ['name' => 'Biela', 'hex' => 'white'],
            ['name' => 'Čierna', 'hex' => 'black'],
            ['name' => 'Viacfarebný', 'hex' => 'linear-gradient(90deg, rgb(20, 190, 130) 0%, rgb(193, 255, 0) 33%, rgb(255, 85, 85) 67%, rgb(0, 92, 198) 100%)']
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }



        // 3. Seedneme produkty
        // Každý produkt dostane náhodne existujúce category_id a supplier_id
        Product::factory()
            ->count(50)
            ->create()
            ->each(function ($product) {
                // Pre každý produkt vytvor 3 obrázky
                ProductImage::factory()
                    ->count(3)
                    ->create([
                        'product_id' => $product->id,
                    ]);
                $velkosti = [5, 6, 7, 8, 9, 10, 11, 12];
                foreach ($velkosti as $size) {
                    ProductSize::factory()->create([
                        'product_id' => $product->id,
                        'us_velkost' => $size,
                        'pocet'      => rand(0, 2),
                    ]);
                }
            });
    }
}
