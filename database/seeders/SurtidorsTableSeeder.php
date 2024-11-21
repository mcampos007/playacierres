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
        $productIds = [ 1, 2, 3, 4 ];

        for ( $i = 1; $i <= 20; $i++ ) {
            Surtidor::create( [
                'name' => 'Surtidor ' . $i,
                'product_id' => $productIds[ array_rand( $productIds ) ],
                'lectura_actual' => 0
            ] );
        }
    }
}
