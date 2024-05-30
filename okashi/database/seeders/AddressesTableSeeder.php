<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lista de direcciones completas
        $addresses = [
            ['street' => 'Calle Gran Vía', 'city' => 'Madrid', 'state' => 'Comunidad de Madrid', 'country' => 'España'],
            ['street' => 'Paseo de Gracia', 'city' => 'Barcelona', 'state' => 'Cataluña', 'country' => 'España'],
            ['street' => 'Calle Colón', 'city' => 'Valencia', 'state' => 'Comunidad Valenciana', 'country' => 'España'],
            ['street' => 'Avenida de la Constitución', 'city' => 'Sevilla', 'state' => 'Andalucía', 'country' => 'España'],
            ['street' => 'Calle del Coso', 'city' => 'Zaragoza', 'state' => 'Aragón', 'country' => 'España'],
            // Añade más direcciones aquí...
        ];

        for($i = 0; $i < 2; $i++){
            // Selecciona una dirección aleatoria de la lista
            $address = $addresses[array_rand($addresses)];

            $a = new Address([
                'street' => $address['street'], // Usa la calle seleccionada
                'city' => $address['city'], // Usa la ciudad seleccionada
                'state' => $address['state'], // Usa el estado seleccionado
                'postal_code' => $i,
                'country' => $address['country'], // Usa el país seleccionado
            ]);
            $a->save();
        }
    }
}
