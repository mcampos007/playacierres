<?php

namespace App\Http\Controllers\Admin;

use App\Models\Turno;
use App\Models\Surtidor;
use App\Models\TurnoDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class TurnoController extends Controller {

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store( Request $request ) {
        //
    }

    public function editarturno( $id ) {
        //

        $turno = Turno::where( 'id', $id )->first();

        return view( 'admin.turnos.edit', compact( 'turno' ) );

    }

    public function edit( $id ) {
        //
    }

    public function update( Request $request, $id ) {
        //
        // Validar los datos del formulario
        $validatedData = $request->validate( [
            'turno' => 'required|string|max:15',
            'fecha' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'efectivo' => 'nullable|numeric',
            'ctacte' => 'nullable|numeric',
            'visa' => 'nullable|numeric',
            'electron' => 'nullable|numeric',
            'maestro' => 'nullable|numeric',
            'mastercard' => 'nullable|numeric',
            'american' => 'nullable|numeric',
            'cheques' => 'nullable|numeric',
            'otros' => 'nullable|numeric',
        ] );
        try {
            // Buscar el turno o lanzar una excepción si no se encuentra
            $turno = Turno::findOrFail( $id );
            // Actualizar el turno con los datos validados
            $turno->update( $validatedData );

            // Redirigir con un mensaje de éxito
            return redirect()->route( 'home' )->with( 'success', 'Turno actualizado correctamente.' );

        } catch ( \Exception $e ) {
            // Manejar errores y redirigir con un mensaje de error
            return redirect()->back()->with( 'error', 'Ocurrió un error al actualizar el turno: ' . $e->getMessage() );

        }

    }

    public function destroy( $id ) {
        //
    }

    public function turnocheck() {
       // $id = 4;
        $turno =  Turno::latest( 'id' )->first();

        return view( 'admin.turnos.verificar', compact( 'turno' ) );
    }

    public function verificaraforador( Request $request ) {

        $turno = $request->input( 'turno' );
        $fecha = $request->input( 'fecha' );
        $surtidorId = $request->input('surtidor_id');

        $turnoActual = Turno::where('turno', $turno)
        ->where('fecha', $fecha)
        ->with('turnoDetails') // Cargar todos los detalles de turno sin filtrar por surtidor_id
        ->first();

        $id =$turnoActual->id;

        $turnoAnterior = Turno::where('id', $id-1)
        ->with('turnoDetails') // Cargar todos los detalles de turno sin filtrar por surtidor_id
        ->first();

        if (!$turnoAnterior){
            $notification = "No hay un turno Anterior, No es posible verificar turnos";

            return redirect()->route('admin.turnoscheck')->with(compact('notification'));

        }

        // Crear una colección para los datos a modificar
        $datosModificar = new Collection();


         // Recorrer los detalles del turno actual
         foreach ($turnoActual->turnoDetails as $detalleActual) {
            // Buscar el detalle correspondiente en el turno anterior
            $detalleAnterior = $turnoAnterior->turnoDetails->firstWhere('surtidor_id', $detalleActual->surtidor_id);

            // Comparar lectura_inicial del turno actual con lectura_final del turno anterior
            if ($detalleAnterior && $detalleActual->lectura_inicial != $detalleAnterior->lectura_final) {
                // Agregar los datos a modificar a la colección
                $datosModificar->push([
                    'id' => $detalleActual->id,
                    'turno_id' => $turnoActual->id,
                    'turno' => $turnoActual->turno,
                    'fecha' => $turnoActual->fecha,
                    'surtidor_id' => $detalleActual->surtidor_id,
                    'lectura_amodificar' => $detalleActual->lectura_inicial,
                    'nueva_lectura' => $detalleAnterior->lectura_final,
                ]);
            }
        }

    //      // Convertir cada elemento a un objeto
    // $datosModificar = array_map(function ($item) {
    //     return (object) $item;
    // }, $datosModificar);




        // Realizar la consulta al modelo Turno y cargar la relación turnoDetails
        // $turnoActual = Turno::where('turno', $turno)
        // ->where('fecha', $fecha)
        // ->whereHas('turnoDetails', function ($query) use ($surtidorId) {
        //     $query->where('surtidor_id', $surtidorId);
        // })
        // ->with(['turnoDetails' => function ($query) use ($surtidorId) {
        //     $query->where('surtidor_id', $surtidorId);
        // }])
        // ->first();

        //dd($turnoActual);



        // Anterior
        // $turnoAnterior = Turno::where('id',$id)
        // ->whereHas('turnoDetails', function ($query) use ($surtidorId) {
        //     $query->where('surtidor_id', $surtidorId);
        // })
        // ->with(['turnoDetails' => function ($query) use ($surtidorId) {
        //     $query->where('surtidor_id', $surtidorId);
        // }])
        // ->first();

        //
        //dd($turnoActual->turnoDetails()->first());
       // dd($datosModificar);
        return view('admin.turnos.turnoaverificar', compact('datosModificar'));

    }

    public function actualizaraforador(Request $request){

        // Recibir los datos del formulario
        $datos = $request->input('datos');
        $seleccionar = $request->input('seleccionar');

        // dd($datos);

        // Iterar sobre los datos recibidos
        foreach ($datos as $index => $dato) {
            // Verificar si este índice está seleccionado para la actualización
            if (isset($seleccionar[$index])) {
                // Obtener los valores del array
                $id = $dato['id'];
                $surtidor_id = $dato['surtidor_id'];
                $nueva_lectura = $dato['nueva_lectura'];

                // Realizar la actualización en la base de datos
                TurnoDetail::where('id', $id)
                    ->where('surtidor_id', $surtidor_id)
                    ->update(['lectura_inicial' => $nueva_lectura]);
            }
        }
        // Redireccionar con un mensaje de éxito
        // return redirect()->route('admin.turnoscheck')->with('success', 'Lecturas actualizadas correctamente.');

        // dd($request);

        // $id = $request->input('id');
        // $surtidor_id = $request->input("surtidor_id");
        // $lectura_propuesta = $request->input("lecturapropuesta");

        // $turnoDetail = TurnoDetail::where('turno_id', $id)
        //                           ->where('surtidor_id', $surtidor_id)
        //                           ->first();
        // if ($turnoDetail) {
        //     // Actualizar el campo lectura_inicial
        //     $turnoDetail->lectura_inicial =$lectura_propuesta;
        //     $turnoDetail->save();
        // }
        $notification = "Lecturas actualizadas correctamente.";



        return redirect('home')->with(compact('notification'));

    }
}
