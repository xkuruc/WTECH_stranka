<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandFactory extends Factory
{
    protected $model = Brand::class;
    public function definition(): array
    {
        $displayName = $this->faker->company(); // napr. "Beier-McCullough"
        $name = preg_replace('/[^A-Za-z0-9]/', '', $displayName);        // napr. "beier-mccullough"

        return [
            'name' => $name,
            'display_name' => $displayName,
        ];
    }
}
