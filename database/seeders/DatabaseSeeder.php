<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;


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
        Category::factory()
            ->count(5)
            ->create();

        // 2. Seedneme dodávateľov (voliteľné)
        Supplier::factory()
            ->count(5)
            ->create();

        // 3. Seedneme produkty
        // Každý produkt dostane náhodne existujúce category_id a supplier_id
        Product::factory()
            ->count(50)
            ->create();

    }
}
