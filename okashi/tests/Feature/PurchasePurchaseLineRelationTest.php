<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Purchase;
use App\Models\PurchaseLine;
use Database\Seeders\DatabaseSeeder;

class PurchasePurchaseLineRelationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }
    public function test_purchase_has_purchase_lines()
    {

        // Obtener una compra de la base de datos
        $purchase = Purchase::first();

        // Verificar que la compra tiene líneas de compra
        $this->assertGreaterThan(0, $purchase->purchaseLines()->count());
    }

    public function test_purchase_line_belongs_to_purchase()
    {
        // Obtener una línea de compra de la base de datos
        $purchaseLine = PurchaseLine::first();
        
        // Verificar que la línea de compra pertenece a una compra
        $this->assertNotNull($purchaseLine->purchase);
    }
}
