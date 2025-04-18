<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['code', 'description', 'discount_percentage', 'valid_from', 'valid_to', 'usage_limit'];

    public function usages()
    {
        return $this->hasMany(PromotionUsage::class);
    }
}

