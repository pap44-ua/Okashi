<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Database\Seeders\DatabaseSeeder;

class UserAddressRelationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to verify that a user can have multiple addresses.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }
    public function test_user_can_have_multiple_addresses()
    {
        // Obtener un usuario de la base de datos
        $user = User::first();
        $addresses = Address::all();

        $user->addresses()->attach($addresses[1]->id);

        // Verificar que el usuario tiene múltiples direcciones asociadas
        $this->assertCount(2, $user->addresses);
    }

    /**
     * Test to verify that an address belongs to a user.
     *
     * @return void
     */
    public function test_address_belongs_to_user()
    {
        // Obtener una dirección de la base de datos
        $address = Address::first();

        // Verificar que la dirección pertenece a un usuario
        $this->assertInstanceOf(User::class, $address->users()->first());
    }
}
