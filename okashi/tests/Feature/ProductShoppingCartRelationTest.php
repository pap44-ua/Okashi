<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\ShoppingCart;
use Database\Seeders\DatabaseSeeder;

class ProductShoppingCartRelationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar los seeders para sembrar la base de datos
        
        $this->seed(DataBaseSeeder::class);
    }

    public function test_product_belongs_to_shopping_carts()
    {
        // Obtener un producto creado por el seeder
        $product = Product::first();

        // Obtener un carrito de compras creado por el seeder
        $cart = ShoppingCart::first();

        // Asociar el producto al carrito de compras con una cantidad específica
        $cart->products()->attach($product, ['quantity' => 1]);

        // Verificar que el producto pertenece al carrito de compras
        $this->assertTrue($product->shoppingCarts->contains($cart));
    }

    public function test_shopping_cart_belongs_to_products()
    {
        // Obtener un producto creado por el seeder
        $product = Product::first();

        // Obtener un carrito de compras creado por el seeder
        $cart = ShoppingCart::first();

       // Asociar el producto al carrito de compras con una cantidad específica
        $cart->products()->attach($product, ['quantity' => 1]);
        
        // Verificar que el carrito de compras pertenece al producto
        $this->assertTrue($cart->products->contains($product));
    }
}
