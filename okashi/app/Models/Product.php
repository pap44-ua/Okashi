<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    //Relaciones
    public function shoppingCarts()
    {
        return $this->belongsToMany(ShoppingCart::class)->withPivot('quantity');
    }

    public function purchaseLines()
    {
        return $this->hasMany(PurchaseLine::class);
    }
}
