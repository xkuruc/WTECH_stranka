<?php

namespace Database\Factories;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Predom definovaná množina obrázkov
        $images = [
            'sample_topanka.jpg',
            'sample_topanka2.jpg',
            'sample_topanka3.jpg',
            'sample_topanka4.jpg',
            'sample_topanka5.jpg',
            'sample_topanka6.jpg'
            
        ];

        return [
            // Asociuje obrázok k produktu – buď nový (factory), alebo priraď manuálne pri vytváraní
            'product_id' => Product::factory(),

            // Vyberie náhodne jednu cestu z definovaného zoznamu
            'image_path' => $this->faker->randomElement($images),
        ];
    }
}
