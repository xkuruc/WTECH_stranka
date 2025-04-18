<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['order_id', 'shipping_method', 'shipped_date', 'delivery_date', 'tracking_number', 'carrier'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
