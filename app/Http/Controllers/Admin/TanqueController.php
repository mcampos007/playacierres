<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tanque;
use App\Models\Product;
use App\Models\Surtidor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TanqueController extends Controller {
    public function index() {
        //
        $tanques = Tanque::all();
        return view( 'admin.tanques.index', compact( 'tanques' ) );
    }

    public function create() {
        //
        $products = Product::all();
        return view( 'admin.tanques.create' )->with( compact( 'products' ) );
    }

    public function store( Request $request ) {
        //
        $request->validate( [
            'nombre' => 'required|max:255',
            'capacidad' => 'required|numeric',
        ] );

        Tanque::create( $request->all() );

        return redirect()->route( 'tanques.index' )
        ->with( 'success', 'Tanque creado exitosamente.' );
    }

    public function show( Tanque $tanque ) {
        //
        return view( 'tanques.show', compact( 'tanque' ) );
    }

    public function edit( Tanque $tanque ) {
        //
        $products = Product::all();
        return view( 'admin.tanques.edit', compact( 'tanque', 'products' ) );

    }

    public function update( Request $request, Tanque $tanque ) {
        //
        $request->validate( [
            'nombre' => 'required|max:255',
            'capacidad' => 'required|numeric',
        ] );

        $tanque->update( $request->all() );

        return redirect()->route( 'tanques.index' )
        ->with( 'success', 'Tanque actualizado exitosamente.' );
    }

    public function destroy( Tanque $tanque ) {
        //
        $tanque->delete();

        return redirect()->route( 'tanques.index' )
        ->with( 'success', 'Tanque eliminado exitosamente.' );
    }

    public function surtidores( $id ) {
        //dd( $id );
        // Obtener los surtidores para el tanque con el id proporcionado
        $surtidores = Surtidor::where( 'tanque_id', $id )->get();

        // Acceder al tanque a través de uno de los surtidores
        if ( $surtidores->isNotEmpty() ) {
            $tanque = $surtidores->first()->tanque;

            // Retornar la vista con los datos del tanque y los surtidores
            return view( 'admin.tanques.surtidores', compact( 'tanque', 'surtidores' ) );
        } else {
            // Manejar el caso en que no haya surtidores para el tanque proporcionado
            return redirect()->back()->with( 'error', 'No se encontraron surtidores para el tanque especificado.' );
        }

    }

    public function quitardeltanque( $id ) {
        return redirect()->back()->with( 'error', 'No se puede dejar un producto sin tanque.' );

    }
}
