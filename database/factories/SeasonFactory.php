<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    /**
     * Model, ku ktorému sa továreň viaže.
     *
     * @var string
     */
    protected $model = Season::class;

    /**
     * Definícia predvoleného stavu modelu.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence(),
        ];
    }
}
