<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShoppingCart;
use App\Models\User;

class ShoppingCartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todos los usuarios de la base de datos
        $users = User::all();
        
        foreach($users as $user) {
            // Crear dos carritos de compras para cada usuario
            for($i = 0; $i < 2; $i++) {
                $shoppingCart = new ShoppingCart();
                $shoppingCart->user()->associate($user->id); // Asociar el carrito con el usuario actual
                $shoppingCart->comprado = true;
                $shoppingCart->save();
                
                // Adjuntar productos al carrito de compras (ajusta según sea necesario)
                $shoppingCart->products()->attach(1, ['quantity' => 3]);
            }
        }
    }
}

