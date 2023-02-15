<?php

use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('products')->insertOrIgnore([
                "name" => "name " . $i,
                "description" => "description" . $i,
                "image" => "",
                "price" => "1000000",
            ]);
        }
    }
}
