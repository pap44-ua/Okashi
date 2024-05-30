<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = DB::table('addresses')->get();

        $user = new User([
            'username' => 'admin', // Usa el nombre de usuario seleccionado
            'email_address' => 'admin@gmail.com', // Usa el email seleccionado
            'password' => Hash::make('admin123'),
            'confirmed' => true,
            'is_admin' => true,
        ]);

        $user->save();

        $user->addresses()->attach($addresses[0]->id);

        // Listas de nombres de usuario y emails
        $usernames = ['JapanFan', 'MegaMan', 'Roku', 'MagiMari', 'AAAA'];
        $emails = ['jpfan', 'megam', 'sixwins', 'stanmari', 'aaaaaa'];

        for($i = 0; $i < 2; $i++){
            // Selecciona un nombre de usuario y un email aleatorios de las listas
            $username = $usernames[array_rand($usernames)];
            $email = $emails[array_rand($emails)];

            $user = new User([
                'username' => $username, // Usa el nombre de usuario seleccionado
                'email_address' => $email . '@gmail.com', // Usa el email seleccionado
                'password' => Hash::make('pass' . $i),
            ]);

            $user->save();

            $user->addresses()->attach($addresses[$i]->id);
        }
    }

}

