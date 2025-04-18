<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionUsage extends Model
{
    protected $fillable = ['promotion_id', 'user_id', 'order_id', 'used_at'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

