<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Model, ku ktorému sa továreň viaže.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Definícia predvoleného stavu modelu.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Názov dodávateľa – napr. firma
            'name' => $this->faker->company(),
            // Voliteľný kontakt, email
            'email' => $this->faker->unique()->companyEmail(),
            // Voliteľná adresa
            'address' => $this->faker->address(),
            // Voliteľné telefónne číslo
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
