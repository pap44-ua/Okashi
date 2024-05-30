<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseLine;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseLinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener instancias de compra y producto
        $purchase = Purchase::first(); // Obtener la primera compra de la base de datos
        $product = Product::first(); // Obtener el primer producto de la base de datos
        
        // Verificar que hay al menos una compra y un producto en la base de datos
        if ($purchase && $product) {
            // Crear y guardar una línea de compra asociada a la compra y al producto obtenidos
            $purchaseLine = new PurchaseLine(['charge' => 10.69, 'quantity' => 1]);
            $purchaseLine->purchase()->associate($purchase);
            $purchaseLine->product()->associate($product);
            $purchaseLine->save();
        } else {
            // Mostrar un mensaje de error si no se encuentran una compra y un producto
            echo "No se encontró una compra o un producto en la base de datos.";
        }
    }
}

