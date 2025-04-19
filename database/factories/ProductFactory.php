<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Zoznam povolených obrázkov
        $images = [
            'public/images/sample_topanka.jpg',
            'public/images/sample_topanka2.jpg',
            'public/images/sample_topanka3.jpg',
            'public/images/sample_topanka4.jpg',
            'public/images/sample_topanka5.jpg',
            'public/images/sample_topanka6.jpg'
        ];
        $nazvy = [
            'Nike Stefan janoski',
            'Nike Airmaxi',
            'Adidas botasky',
            'Pumy',
            'Nike Air 2',
            'Jorda 1 HI',
            'Jorda 1 Lo'
        ];
        return [
            'name'           => $this->faker->randomElement($nazvy),                            // náhodné slovo :contentReference[oaicite:2]{index=2}
            'description'    => $this->faker->sentence(),                        // náhodná veta :contentReference[oaicite:3]{index=3}
            'price'          => $this->faker->randomFloat(2, 1, 100),            // desaťinné číslo s dvoma des. miestami :contentReference[oaicite:4]{index=4}
            'discount'       => $this->faker->randomFloat(2, 0, 30),             // zľava od 0 do 30 € :contentReference[oaicite:5]{index=5}
            'SKU'            => strtoupper($this->faker->bothify('???###')),     // kombinácia písmen a čísiel :contentReference[oaicite:6]{index=6}
            'category_id'    => \App\Models\Category::factory(),                 // vytvorí aj kategóriu cez jej továrničku :contentReference[oaicite:7]{index=7}
            'supplier_id'    => \App\Models\Supplier::factory(),                 // vytvorí aj dodávateľa cez jeho továrničku :contentReference[oaicite:8]{index=8}
            'stock_quantity' => $this->faker->numberBetween(0, 100),             // náhodný počet kusov na sklade :contentReference[oaicite:9]{index=9}
            'brand'          => $this->faker->company(),                         // názov firmy ako značka produktu :contentReference[oaicite:10]{index=10}
            // Tu vyberieme obrázok zo zoznamu
            // 'image_path'     => $this->faker->randomElement($images),
        ];
    }
}
