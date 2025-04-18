<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'payment_date', 'amount', 'payment_method', 'transaction_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
