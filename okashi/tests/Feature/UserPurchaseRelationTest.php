<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Purchase;
use Database\Seeders\DatabaseSeeder;

class UserPurchaseRelationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }

    public function test_user_can_have_multiple_purchases()
    {
        // Obtener un usuario de la base de datos
        $user = User::first();

        // Verificar que el usuario tiene múltiples compras
        $this->assertGreaterThan(0, $user->purchases->count());
    }

    public function test_purchase_belongs_to_a_user()
    {
        // Obtener una compra de la base de datos
        $purchase = Purchase::first();

        // Verificar que la compra pertenece a un usuario
        $this->assertInstanceOf(User::class, $purchase->user);
    }
}
