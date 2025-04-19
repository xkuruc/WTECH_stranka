<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Model, ku ktorému sa továreň viaže.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Definícia predvoleného stavu modelu.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Napríklad jednoslovný názov kategórie
            'name' => $this->faker->word(),
            // Voliteľný popis kategórie
            'description' => $this->faker->sentence(),
        ];
    }
}
