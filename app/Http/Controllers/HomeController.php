<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turno;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index() {
        $notification = false;
        $turno = Turno::where( 'status', false )->get();
        if ( count( $turno )>0 ) {
            if ( $turno->first()->user_id !== auth()->user()->id ) {
                $notification = 'Existe un turno abierto por el usuario: '.$turno->first()->user->name;
            }
        }

        if ( auth()->user()->role === 'admin' ) {
            $turnoscerrados = Turno::where( 'status', true )
            ->orderBy( 'id', 'desc' )->paginate( 5 );
        } else {
            $turnoscerrados = Turno::where( 'status', true )->where( 'user_id', auth()->user()->id )->orderBy( 'id', 'desc' )->paginate( 5 );

        }

        $nuevo = count( $turno ) === 0;

        return view( 'home', compact( 'turno', 'turnoscerrados', 'nuevo', 'notification' ) );
    }
}
