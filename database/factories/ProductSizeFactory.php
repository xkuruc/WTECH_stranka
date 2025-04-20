<?php
namespace Database\Factories;

use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    protected $model = ProductSize::class;

    public function definition()
    {
        $usSizes = [6, 7, 8, 9, 10, 11, 12, 13];

        return [
            // product_id sa prepíše v create() vyššie
            'us_velkost' => $this->faker->randomElement($usSizes),
        ];
    }
}
