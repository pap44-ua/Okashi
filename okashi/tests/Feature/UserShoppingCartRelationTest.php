<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\ShoppingCart;
use Database\Seeders\DatabaseSeeder;

class UserShoppingCartRelationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to verify that a shopping cart belongs to a user.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }
    public function test_shopping_cart_belongs_to_user()
    {

        // Obtener un usuario de la base de datos
        $user = User::first();

        // Verificar que el usuario tiene un carrito de compras asociado
        $this->assertInstanceOf(ShoppingCart::class, $user->shoppingCarts()->first());
    }

    /**
     * Test to verify that a user can have multiple shopping carts.
     *
     * @return void
     */
    public function test_user_can_have_multiple_shopping_carts()
    {

        // Obtener un usuario de la base de datos
        $user = User::first();

        // Verificar que el usuario tiene múltiples carritos de compras asociados
        $this->assertCount(2, $user->shoppingCarts);
    }
}
