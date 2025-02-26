<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanquesSeeder extends Seeder {
    public function run() {
        $tanques = [
            [ 'nombre' => 'Tanque 1', 'capacidad' => 20000, 'product_id' =>  2 ],
            [ 'nombre' => 'Tanque 2', 'capacidad' => 20000, 'product_id' =>  1 ],
            [ 'nombre' => 'Tanque 3', 'capacidad' => 20000, 'product_id' =>  4 ],
            [ 'nombre' => 'Tanque 4', 'capacidad' => 20000, 'product_id' =>  1 ],
            [ 'nombre' => 'Tanque 5', 'capacidad' => 20000, 'product_id' =>  3 ],
            [ 'nombre' => 'Tanque 6', 'capacidad' => 20000, 'product_id' =>  3 ],
            [ 'nombre' => 'Tanque 7', 'capacidad' => 20000, 'product_id' =>  3 ],
        ];

        DB::table( 'tanques' )->insert( $tanques );
    }
}

