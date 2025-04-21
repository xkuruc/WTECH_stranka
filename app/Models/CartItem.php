<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'session_id', 'product_id', 'quantity', 'size'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
