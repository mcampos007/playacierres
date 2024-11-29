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

    //Agregar Surtidor al <tanque></tanque>

    public function addSurtidor( $tanque_id, $surtidor_id ) {
        $surtidor = Surtidor::find( $surtidor_id );
        if ( !$surtidor ) {
            return redirect()->back()->with( 'error', 'El surtidor especificado no existe.' );
        }

        $surtidor->tanque_id = $tanque_id;
        $surtidor->save();

        return redirect()->route( 'tanques.surtidores', [ 'id' => $tanque_id ] )
        ->with( 'success', 'El surtidor se ha agregado correctamente al tanque.' );
    }

    public function destroy( Tanque $tanque ) {
        //
        $tanque->delete();

        return redirect()->route( 'tanques.index' )
        ->with( 'success', 'Tanque eliminado exitosamente.' );
    }

    // Métdodo para llamar la vista de surtidores en el tanque y los surtidores disponibles

    public function surtidores( $id ) {

        // Obtener los surtidores para el tanque con el id proporcionado
        $surtidores = Surtidor::where( 'tanque_id', $id )->get();

        // Obtener el tanque correspondiente
        $tanque = Tanque::find( $id );

        // Obtener los surtidores no asociados a ningún tanque
        //  $surtidoresSinTanque = Surtidor::whereNull( 'tanque_id' )->get();
        $surtidoresSinTanque = Surtidor::whereNull( 'tanque_id' )
        ->where( 'product_id', $tanque->product_id )
        ->get();

        // Si el tanque no existe
        if ( !$tanque ) {
            return redirect()->route( 'tanques.index' )->with( 'error', 'El tanque especificado no existe.' );
        }

        // Retornar siempre la vista con todos los datos
        return view( 'admin.tanques.surtidores', compact( 'tanque', 'surtidores', 'surtidoresSinTanque' ) );

        // // Acceder al tanque a través de uno de los surtidores
        // if ( $surtidores->isNotEmpty() ) {
        //     $tanque = $surtidores->first()->tanque;

        //     // Retornar la vista con los datos del tanque y los surtidores
        //     return view( 'admin.tanques.surtidores', compact( 'tanque', 'surtidores' ) );
        // } else {
        //     // Manejar el caso en que no haya surtidores para el tanque proporcionado
        //     return redirect()->back()->with( 'error', 'No se encontraron surtidores para el tanque especificado.' );
        // }

    }

    public function quitardeltanque( $id ) {
        // Buscar el surtidor por ID
        $surtidor = Surtidor::find( $id );

        // Verificar si el surtidor existe
        if ( !$surtidor ) {
            return redirect()->back()->with( 'error', 'El surtidor especificado no existe.' );
        }

        // Actualizar el campo tanque_id a NULL
        $surtidor->tanque_id = null;
        $surtidor->save();

        // Mensaje de éxito
        return redirect()->back()->with( 'success', 'El surtidor ha sido retirado del tanque con éxito.' );

    }
}
