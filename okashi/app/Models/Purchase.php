<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Purchase extends Model
{
    public $timestamps = false;

    //Relaciones

    public function purchaseLines()
    {
        return $this->hasMany(PurchaseLine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
