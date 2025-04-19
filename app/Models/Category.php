<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Vyplň namiesto 'name' a 'description' tie stĺpce, čo máš v migrácii
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Vzťah: jedna kategória má mnoho produktov.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
