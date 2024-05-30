<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ShoppingCart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call( AddressesTableSeeder::class );
        $this->call( UsersTableSeeder::class );
        $this->call( ProductsTableSeeder::class );
        $this->call( PurchasesTableSeeder::class );
        $this->call( PurchaseLinesTableSeeder::class );
        $this->call( ShoppingCartsTableSeeder::class );
    }
}
