<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'address_type', 'street', 'city', 'postal_code', 'country', 'is_default'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
