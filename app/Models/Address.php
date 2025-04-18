<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'address_id'; // Tu špecifikuj, že primárny kľúč je 'address_id'
    public $incrementing = true;
    protected $fillable = ['user_id', 'address_type', 'ulica', 'cisloDomu', 'mesto', 'psc', 'krajina', 'is_default'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
