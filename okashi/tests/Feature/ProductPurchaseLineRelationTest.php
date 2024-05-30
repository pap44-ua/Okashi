<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\PurchaseLine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class ProductPurchaseLineRelationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }

    public function test_product_has_purchase_lines()
    {

        // Obtener un producto de la base de datos
        $product = Product::first();

        // Verificar que el producto tiene líneas de compra relacionadas
        $this->assertGreaterThan(0, $product->purchaseLines()->count());
    }

    public function test_purchase_line_belongs_to_product()
    {

        // Obtener una línea de compra de la base de datos
        $purchaseLine = PurchaseLine::first();
        
        // Verificar que la línea de compra pertenece a un producto
        $this->assertNotNull($purchaseLine->product);
    }
}
