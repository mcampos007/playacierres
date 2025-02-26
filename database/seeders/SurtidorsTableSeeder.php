<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Surtidor;

class SurtidorsTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        //
        // $productIds = [ 1, 2, 3, 4 ];

        // for ( $i = 1; $i <= 20; $i++ ) {
        //     Surtidor::create( [
        //         'name' => 'Surtidor ' . $i,
        //         'product_id' => $productIds[ array_rand( $productIds ) ],
        //         'lectura_actual' => 0
        // ] );
        // }

        Surtidor::create( [
            'name' => 'Surtidor 1' ,
            'product_id' => 2,
            'tanque_id' => 1,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 2' ,
            'product_id' => 1,
            'tanque_id' => 2,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 3' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 4' ,
            'product_id' => 2,
            'tanque_id' => 1,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 5' ,
            'product_id' => 1,
            'tanque_id' => 2,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 6' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 7' ,
            'product_id' => 2,
            'tanque_id' => 1,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 8' ,
            'product_id' => 1,
            'tanque_id' => 2,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 9' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 10' ,
            'product_id' => 2,
            'tanque_id' => 1,
            'lectura_actual' => 0
        ] );
        Surtidor::create( [
            'name' => 'Surtidor 11' ,
            'product_id' => 1,
            'tanque_id' => 2,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 12' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 13' ,
            'product_id' => 3,
            'tanque_id' => 5,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 14' ,
            'product_id' => 1,
            'tanque_id' => 4,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 15' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 16' ,
            'product_id' => 3,
            'tanque_id' => 5,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 17' ,
            'product_id' => 1,
            'tanque_id' => 4,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 18' ,
            'product_id' => 4,
            'tanque_id' => 3,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 19' ,
            'product_id' => 3,
            'tanque_id' => 6,
            'lectura_actual' => 0
        ] );

        Surtidor::create( [
            'name' => 'Surtidor 20' ,
            'product_id' => 3,
            'tanque_id' => 7,
            'lectura_actual' => 0
        ] );

    }
}
