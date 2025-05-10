<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    // ak máte v migrácii len created_at a nie updated_at
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'price',
        'status',
        'created_at',
    ];
    // castujeme na Carbon
    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }
}
