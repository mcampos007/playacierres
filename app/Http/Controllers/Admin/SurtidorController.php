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
        // Validar los datos del formulario
        dd( $id );
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'producto' => 'required|exists:products,id',
            'lectura_actual' => 'required|numeric|min:0|max:999999.99',
            'tanque_id' => 'nullable|exists:tanques,id',
        ], [
            'lectura_actual.min' => 'La lectura actual debe ser un valor mayor o igual a 0.',
            'lectura_actual.max' => 'La lectura actual debe ser un valor inferior a 1000000.',
            'producto.exists' => 'El producto seleccionado no es válido.',
            'tanque_id.exists' => 'El tanque seleccionado no es válido.',
        ] );

        // Obtener el surtidor
        $surtidor = Surtidor::findOrFail( $id );

        // Verificar si el tanque tiene un producto diferente al del surtidor
        if ( $validatedData[ 'tanque_id' ] ) {
            $tanque = Tanque::find( $validatedData[ 'tanque_id' ] );
            if ( $tanque && $tanque->product_id !== $validatedData[ 'producto' ] ) {
                return redirect()->back()->withErrors( [
                    'tanque_id' => 'El producto asociado al tanque seleccionado no coincide con el producto del surtidor.',
                ] )->withInput();
            }
        }

        // Actualizar los valores del surtidor
        $surtidor->name = $validatedData[ 'name' ];
        $surtidor->product_id = $validatedData[ 'producto' ];
        $surtidor->lectura_actual = $validatedData[ 'lectura_actual' ];
        //  $surtidor->tanque_id = $validatedData[ 'tanque_id' ];
        $surtidor->save();

        // Redireccionar con un mensaje de éxito
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
        try {
            // Buscar el surtidor
            $surtidor = Surtidor::findOrFail( $id );

            // Intentar eliminar
            $surtidor->delete();

            // Notificación de éxito
            return redirect()->route( 'admin.surtidors' )->with( 'notification', 'El surtidor se ha eliminado correctamente.' );
        } catch ( \Illuminate\Database\QueryException $e ) {
            // Capturar error de restricción de relaciones
            if ( $e->getCode() === '23000' ) {
                // Código de violación de clave foránea
                return redirect()->route( 'admin.surtidors' )->with( 'msj', 'No se pudo eliminar el surtidor porque está relacionado con otros registros.' );
            }

            // Otro error de base de datos
            return redirect()->route( 'admin.surtidors' )->with( 'msj', 'Ocurrió un error en la base de datos.' );
        } catch ( \Exception $e ) {
            // Capturar cualquier otro error
            return redirect()->route( 'admin.surtidors' )->with( 'msj', 'Ocurrió un error inesperado: ' . $e->getMessage() );
        }
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
