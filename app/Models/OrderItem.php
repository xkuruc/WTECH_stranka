<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'discount'];
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];


    public function order()
    {
        return $this->belongsTo(UserOrder::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
