<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
        //
        User::create( [
            'name' => 'mario',
            'email'=> 'mcampos@infocam.com.ar',
            'password' => bcrypt( 'Cc2024Inf' ),
            // 'admin' => true,
            'role' => 'admin'
        ] );
        User::create( [
            'name' => 'cesar',
            'email'=> 'cesar.campos@infocam.com.ar',
            'password' => bcrypt( 'Cc2024Inf' ),
            // 'admin' => true,
            'role' => 'admin'
        ] );
        User::create( [
            'name' => 'playeroll',
            'email'=> 'playeroll@infocam.com.ar',
            'password' => bcrypt( '1234qwer' ),
            // 'admin' => true,
            'role' => 'user'
        ] );
    }
}
