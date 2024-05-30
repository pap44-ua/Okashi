<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$users = DB::table('users')->get();
        $users = User::all();

        for($i = 0; $i < 10; $i++){
            $p = new Purchase(['date' => date("Y-m-d H:i:s")]);
            $p->user()->associate($users[$i % count($users)]);
            $p->save();
        }
    }
}
