<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Polia povolené pre masívne priradenie.
     * Nezahrňuj tu 'id', Eloquent ho spravuje automaticky.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'SKU',
        'category_id',
        'supplier_id',
        'stock_quantity',
        'brand_id',
        'image_basename',
        'available',    // boolean (na sklade / vypredané)
        'gender',      // string (napr. 'Pánske', 'Dámske', 'Unisex')
        'color_id',       // string (napr. 'Biela', 'Čierna'...)
        'type',        // string (napr. 'Tenisky', 'Tričko'...)
        'season_id',
    ];  // :contentReference[oaicite:0]{index=0}

    /**
     * Automatické pretypovanie atribútov pri čítaní/zápise.
     *
     * @var array
     */
    protected $casts = [
        'price'          => 'decimal:2',
        'discount'       => 'decimal:2',
        'stock_quantity' => 'integer',
    ];  // :contentReference[oaicite:1]{index=1}

    public const UPDATED_AT = null;

    /**
     * Vzťah na kategóriu – každý produkt patrí do jednej kategórie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }  // :contentReference[oaicite:2]{index=2}

    public function season()
    {
        return $this->belongsTo(Season::class);
    }


    /**
     * Vzťah na dodávateľa – každý produkt má jedného dodávateľa.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }  // :contentReference[oaicite:3]{index=3}

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);  // každý produkt patrí k jednej farbe
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }


    public function availableSizes(): array
    {
        return $this->productSizes()
                    ->where('pocet', '>', 0)      // iba tie, čo majú viac ako 0 kusov
                    ->orderBy('us_velkost')      // zoradiť podľa veľkosti
                    ->pluck('us_velkost')        // vybrať len stĺpec us_velkost
                    ->toArray();                 // vrátiť ako čisté pole
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

}
