<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Listas de descripciones, precios y marcas
        $descriptions = [
            'Excelente producto', 
            'Ideal para un snack', 
            'Producto de alta calidad', 
            'Producto ecológico', 
            'Producto duradero'
        ];
        $prices = [1.00, 1.50, 1.99, 2.50, 2.99, 3.99, 4.99, 5.99, 6.50, 7.99, 9.99, 19.99];
        $brands = ['Chips Star', 'Black Thunder', 'Pringles', 'Buggy', 'Ajinomoto', 'Ajisen Ramen', 'Aruchan', 'Asahi', 'Kirin'];
        $stocks = [5, 15, 32, 45, 49, 57, 69, 73, 94, 100];
        $names = ['Chips Bowser',
                'Chips Peach',
                'Chocolatina Black Thunder',
                'Curry japones', 
                'Fresas con chocolate', 
                'Galleta Senbei',
                'Galletas Shin Chan', 
                'Galleta de la suerte', 
                'Galletas de verano Shin Chan',
                'Kit kat XXL',
                'Kit kat fresa',
                'Lichis en almibar',
                'Monster melocoton',
                'Pack de dulces japoneses',
                'Patatas Chips Star Premium Ebi-Nori',
                'Patatas Monster Munch',
                'Patatas Super Mario Yoshi',
                'Topokki Receta Ramen Coreano BULDAK ULTRA HOT',
                'Pringles Alga',
                'Pringles Cangrejo Picante',
                'Pringles Limon Picante',
                'Fideos Ramen Coreano Salteado Wok 4 Quesos',
                'Fideos Nissin Chikin Ramen',
                'Snack Buggy',
                'Tarta de fresa con chuches',
                'Obleas de Arroz para Rollitos'
            ];
        $images = ['chips-star-pollo-bowser.png',
                    'chip-star-peach.png',
                    'chocolatina-black-thunder.png',
                    'curry.png',
                    'dulce_fresa.png', 
                    'galleta-senbei.png',
                    'galletas_shin_chan.png',
                    'galleta_suerte.png',
                    'galletas_verano.png', 
                    'kit kat.png', 
                    'kit-kat-fresa.png',
                    'lichis.png',
                    'monster_melocoton.png', 
                    'pack.png', 
                    'patatas.png', 
                    'patatas-monster-munch.png',
                    'patatas-super-mario-yoshi.png',
                    'picante.png',
                    'pringles-alga.png',
                    'pringles-cangrejo-picante.png',
                    'pringles-limon-picante.png',      
                    'ramen.png', 
                    'ramen_huevo.png', 
                    'snack-buggy.png',
                    'tartaFresaChuches.png',
                    'verduras.png'];

        for($i = 0; $i < 26; $i++){
            // Selecciona una descripción, precio, marca, stock y nombre aleatorios de las listas
            $description = $descriptions[array_rand($descriptions)];
            $price = $prices[array_rand($prices)];
            $brand = $brands[array_rand($brands)];
            $stock = $stocks[array_rand($stocks)];
            $name = $names[$i];
            $image = $images[$i];

            //$name = $names[array_rand($names)];

            $p = new Product([
                'name' => $name, // Usa el nombre seleccionado
                'description' => $description, // Usa la descripción seleccionada
                'price' => $price, // Usa el precio seleccionado
                'brand' => $brand, // Usa la marca seleccionada
                'stock' => $stock, // Usa el stock seleccionado
                'image' => $image
            ]);
            $p->save();
        }

        

    }
}
