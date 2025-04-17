<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'registration_date'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }


    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function promotionUsages()
    {
        return $this->hasMany(PromotionUsage::class);
    }
}

