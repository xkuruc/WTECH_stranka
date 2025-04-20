<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = ['product_id', 'us_velkost'];

    // ak si tabuľku pomenoval inak než automaticky (product_sizes), prideľ
    // protected $table = 'product_sizes';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
