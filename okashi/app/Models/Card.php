<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id', 'card_name', 'card_number', 'cvv', 'expiry_date', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
