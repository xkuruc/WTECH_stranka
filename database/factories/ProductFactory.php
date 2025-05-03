<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Season;
use App\Models\Color;
use App\Models\Supplier;

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
        $available_miesta = ['Bratislava', 'Praha','Košice', 'Skladom'];
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
            'supplier_id'    => Supplier::factory(),                 // vytvorí aj dodávateľa cez jeho továrničku
            'stock_quantity' => $stock_quantity,                                 // náhodný počet kusov na sklade
            'brand_id'       => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),                                // názov firmy ako značka produktu


            // Tu vyberieme obrázok zo zoznamu
            'available'      => $available,
            'gender'         => $this->faker->randomElement($genders),           // náhodný gender
            'color_id'       => Color::inRandomOrder()->first()->id,            // náhodná farba
            'type'           => $this->faker->randomElement($types),             // náhodný typ produktu
            'season_id'      => Season::inRandomOrder()->first()->id, // sezóna
            'created_at'     => $this->faker->dateTimeBetween('-1 years', 'now'),

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $sampleSets = ['sample_topanka1', 'sample_topanka2', 'sample_topanka3', 'sample_topanka4', 'sample_topanka5', 'sample_topanka6'];

            // Vyber náhodnú sadu obrázkov
            $chosenSet = $sampleSets[array_rand($sampleSets)];

            // Vytvor hlavný obrázok v `product_images` so značkou 'is_main'
            $product->images()->create([
                'image_path' => "{$chosenSet}/{$chosenSet}_main.jpg",
                'is_main' => true, // Tento obrázok je hlavný
            ]);

            // Vytvor vedľajšie obrázky v `product_images` (ak existujú)
            for ($i = 1; $i <= 4; $i++) {
                $filename = public_path("images/{$chosenSet}/{$chosenSet}_side{$i}.jpg");
                if (file_exists($filename)) {
                    $product->images()->create([
                        'image_path' => "{$chosenSet}/{$chosenSet}_side{$i}.jpg",
                        'is_main' => false, // Vedľajší obrázok
                    ]);
                }
            }
        });
    }
}
