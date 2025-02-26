<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        //
        DB::table( 'products' )->insert( [
            [
                'name' => 'SUPER',
                'price' => 1135,
            ],
            [
                'name' => 'QUANTIUM',
                'price' => 1375,
            ],
            [
                'name' => 'AXION DIESEL X10',
                'price' => 1269,
            ],
            [
                'name' => 'QUANTIUM DIESEL X10',
                'price' => 1407,
            ],
            // Agrega más registros si lo deseas
        ] );
    }
}
