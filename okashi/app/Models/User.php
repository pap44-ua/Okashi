<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $table = 'users';

    protected $fillable = [
        'username', 'email_address', 'password', 'confirmation_code', 'mfa_enabled','mfa_code','mfa_code_expires_at'
    ];
    
    public $timestamps = false;

    //Realciones
    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function getEmailByUsername($username)
    {
        // Buscar el usuario por su nombre de usuario y obtener su correo electrónico
        $user = $this->where('username', $username)->first();

        // Verificar si se encontró el usuario
        if ($user) {
            // Retornar el correo electrónico si el usuario existe
            return $user->email_address;
        } else {
            // Retornar null si el usuario no existe
            return null;
        }
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }


    //Métodos
    public function isAdmin()
    {
        $user = Auth()->user();
        return $user->is_admin;
    }

    

}
