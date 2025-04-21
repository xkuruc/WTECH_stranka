<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $incrementing = false;    // lebo máš string PK
    protected $keyType = 'string';

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'session_id', 'id');
    }
}