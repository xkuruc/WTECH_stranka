<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Vzťah: jedna sezóna má mnoho produktov.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
