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
        'brand',

        'in_stock',    // boolean (na sklade / vypredané)
        'gender',      // string (napr. 'Pánske', 'Dámske', 'Unisex')
        'color',       // string (napr. 'Biela', 'Čierna'...)
        'type',        // string (napr. 'Tenisky', 'Tričko'...)
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
        'in_stock'       => 'boolean',
    ];  // :contentReference[oaicite:1]{index=1}
    
    public const UPDATED_AT = null;

    /**
     * Vzťah na kategóriu – každý produkt patrí do jednej kategórie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }  // :contentReference[oaicite:2]{index=2}

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
    public function availableSizes(): array
    {
        // Tu si zadefinuj veľkosti podľa potrieb:
        return ['6', '7', '8', '9', '10', '11'];
    }

    // public static function sortedByPrice(?string $sort = null)
    // {
    //     $direction = $sort
    //         ?? request()->get('sort', 'asc');

    //     // whitelist (len asc/desc)
    //     $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';

    //     return static::orderBy('price', $direction)->get();
    // }
}
