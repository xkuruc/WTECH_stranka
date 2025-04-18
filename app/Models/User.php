<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;


class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['meno', 'priezvisko', 'email', 'password', 'telephone', 'pohlavie', 'datum_narodenia', 'newsletter', 'registration_date'];
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';


    public function address()
    {
        return $this->hasMany(Address::class, 'user_id', 'user_id');
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

    public function personalizacia()
    {
        return $this->hasOne(Personalizacia::class, 'user_id', 'user_id');
    }
}

