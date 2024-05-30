<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    //Relaciones
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = [
        'id',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
    ];

}
