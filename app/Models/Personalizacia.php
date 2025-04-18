<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personalizacia extends Model
{
    protected $table = 'personalizacia';
    protected $fillable = [
        'user_id',
        'vyska',
        'hmotnost',
        'velkost_topanok',
        'znacka',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
