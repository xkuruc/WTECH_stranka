<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductImage;
use App\Models\Brand;

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
            'sample_topanka.jpg',
            'sample_topanka2.jpg',
            'sample_topanka3.jpg',
            'sample_topanka4.jpg',
            'sample_topanka5.jpg',
            'sample_topanka6.jpg'
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
        $genders = ['Pánske', 'Dámske', 'Unisex'];


        $types = ['Tenisky','Kopacky','Lopty'];
        $available_miesta = ['Bratislava', 'Praha','Brno', 'Skladom'];
        $stock_quantity =  $this->faker->numberBetween(0, 100);

        if ($stock_quantity == 0) {
            $available = 'Momentálne vypredané';
        } else {
            //ak je, tak si vyberie náhodne či je na sklade alebo na predajni
            $available = $this->faker->randomElement($available_miesta);
        }

        return [
            'name'           => $this->faker->randomElement($nazvy),             // náhodné slovo
            'description'    => $this->faker->sentence(),                        // náhodná veta
            'price'          => $this->faker->randomFloat(2, 1, 500),            // desaťinné číslo s dvoma des. miestami
            'discount'       => rand(0, 1) ? $this->faker->randomFloat(2, 0.01, 30) : 0.00,  // 50% bude mať zlavu
            'SKU'            => strtoupper($this->faker->bothify('???###')),     // kombinácia písmen a čísiel
            'supplier_id'    => \App\Models\Supplier::factory(),                 // vytvorí aj dodávateľa cez jeho továrničku
            'stock_quantity' => $stock_quantity,                                 // náhodný počet kusov na sklade
            'brand_id'       => Brand::factory(),                    // názov firmy ako značka produktu


            // Tu vyberieme obrázok zo zoznamu
            'main_image'     => $this->faker->randomElement($images),
            'available'      => $available,
            'gender'         => $this->faker->randomElement($genders),           // náhodný gender
            'color_id'          => \App\Models\Color::inRandomOrder()->first()->id,            // náhodná farba
            'type'           => $this->faker->randomElement($types),             // náhodný typ produktu
            'season_id'      => \App\Models\Season::factory(),                   // sezóna
            'created_at'  => $this->faker->dateTimeBetween('-1 years', 'now'),

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // pre každý produkt vytvor 3–5 obrázkov
            ProductImage::factory()
                ->count(rand(3,5))
                ->create(['product_id' => $product->id]);
        });
    }
}
