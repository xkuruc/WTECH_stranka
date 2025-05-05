<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'is_main',
    ];

    /**
     * Každý obrázok patrí k jednému produktu.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
