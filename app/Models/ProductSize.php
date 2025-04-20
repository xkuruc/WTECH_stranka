<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'us_velkost',
        'pocet',
    ];

    /** 
     * Vzťah späť na produkt 
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
