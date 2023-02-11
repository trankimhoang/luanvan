<?php

use Illuminate\Database\Seeder;

class CustomerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('customers')->insertOrIgnore([
                "name" => "name " . $i,
                "email" => "name" . $i . "@gmail.com",
                "address" => "address " . $i,
                "phone" => "0123456789",
                "password" =>\Illuminate\Support\Facades\Hash::make('123')
            ]);
        }
    }
}
