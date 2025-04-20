<?php

namespace Database\Factories;

use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    protected $model = ProductSize::class;

    public function definition()
    {
        return [
            'us_velkost' => $this->faker->randomFloat(2, 5, 12),  // napr. od 5.00 do 12.00
            'pocet'      => $this->faker->numberBetween(0, 50),   // 0–50 kusov
        ];
    }
}
