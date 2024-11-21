<?php

namespace App\Http\Controllers\Admin;

use App\Models\Surtidor;
use App\Models\Product;
use App\Models\Tanque;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurtidorController extends Controller {
    public function index() {
        //
        $surtidors = Surtidor::paginate( 10 );
        return view( 'admin.surtidors.index' )->with( compact( 'surtidors' ) );
    }

    public function create() {
        //
        $products = Product::all();
        $surtidor = New Surtidor();
        return view( 'admin.surtidors.create', compact( 'products', 'surtidor' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //
        //Validación
        $rules = [
            'name' => 'required|min:5|max:45',
            'product_id' => 'required|numeric',
            'lectura_actual' => 'required|numeric'
        ];
        $messages = [
            'name.required' => 'Debe Ingresar un nombre para el surtidor',
            'name.min' => 'El nombre del surtidor debe tener al menos cinco caracteres.',
            'name.max' => 'El nombre del surtidor NO debe tener mas de 45 caracteres.',
            'lectura_actual.required' => 'El surtidor debe tener un valor.'

        ];
        $this->validate( $request, $rules, $messages );

        $surtidor = new Surtidor();
        $surtidor->name = $request->input( 'name' );
        $surtidor->product_id = $request->input( 'product_id' );
        $surtidor->lectura_actual = $request->input( 'lectura_actual' );
        $surtidor->save();
        $notification = 'El nuevo surtidor se ha creado correctamente';
        return redirect()->route( 'admin.surtidors' )->with( compact( 'notification' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
        $surtidor = Surtidor::findOrFail( $id );
        $products = Product::all();
        $tanques = Tanque::all();
        return view( 'admin.surtidors.edit' )->with( compact( 'surtidor', 'products', 'tanques' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
        $surtidor = Surtidor::findOrFail( $id );
        $surtidor->name = $request->input( 'name' );
        $surtidor->product_id = $request->input( 'producto' );
        $surtidor->lectura_actual = $request->input( 'lectura_actual' );
        $surtidor->tanque_id = $request->input( 'tanque_id' );
        $surtidor->save();
        return redirect()->route( 'admin.surtidors' ) ->with( 'success', 'Surtidor actualizado exitosamente.' );
        ;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function delete( $id ) {
        //
        $surtidor = Surtidor::findOrFail( $id );
        if ( !$surtidor->id ) {
            $notification = 'NO se pudo eliminar el surtidor!';
        } else {
            $surtidor->delete();
            $notification = 'El surtidor se ha eliminado';
        }

        return redirect()->route( 'admin.surtidors' )->with( compact( 'notification' ) );
    }

    public function changetanque( $id ) {
        $surtidor = Surtidor::find( $id );
        $tanques = Tanque::all();

        // Verifica si el surtidor fue encontrado
        if ( !$surtidor ) {
            // Si no se encuentra, redirige con un mensaje de error
            return redirect()->back()->with( 'error', 'Surtidor no encontrado.' );
        }

        // Si se encuentra, retorna la vista con los detalles del surtidor
        return view( 'admin.surtidors.changetanque', compact( 'surtidor', 'tanques' ) );
    }

    public function updatetanque( Request $request, $id ) {
        $surtidor = Surtidor::find( $id );
        $surtidor->tanque_id = $request->input( 'tanque_id' );
        $surtidor->save();
        return redirect()->route( 'admin.surtidors' ) ->with( 'success', 'Surtidor actualizado exitosamente.' );
        ;

    }
}
