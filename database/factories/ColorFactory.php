<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->colorName(),  // Generuje náhodný názov farby (napr. Červená, Modrá)
            'hex'  => $this->faker->hexColor(),             // Generuje náhodný HEX kód farby
        ];
    }
}
