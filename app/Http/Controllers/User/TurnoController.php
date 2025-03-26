<?php

namespace App\Http\Controllers\User;
use App\Models\Turno;
use App\Models\Surtidor;
use App\Models\TurnoDetail;
use App\Models\Tanque;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use PDF;

class TurnoController extends Controller
{
    // Establecer Fecha Actual
    public function asignarFechaSistema()
    {
        $fechaSistema = Carbon::now()->toDateString();

        return $fechaSistema;
    }
    // Asignar turno
    public function asignarTurno()
    {
        $now = Carbon::now();
        $hora = $now->format('H:i');

        $turno = "";

        if ($hora >= '06:00' && $hora <= '14:00') {
            $turno = 'NOCHE';
        } elseif ($hora >= '14:01' && $hora <= '22:00') {
            $turno = 'MAÑANA';
        } elseif ($hora >= '22:01' && $hora <= '23:59') {
            $turno = 'TARDE';
        }
        elseif ($hora >= '00:00' && $hora <= '05:59') {
            $turno = 'TARDE';
        }


        return $turno;
    }

    // Buscar Detalles para un turno
    public function detallesdelturno($id)
    {
        $surtidores = Surtidor::all();

        if ($id>0){
            $turno_Details = TurnoDetail::where('turno_id',$id)->get();
            if (count($turno_Details) == 0)
            {
                $turno_Details = [];
                foreach($surtidores as $surtidor){
                    $turnoDetail = new TurnoDetail();
                    $turnoDetail->turno_id = NULL;
                    $turnoDetail->surtidor_id = $surtidor->id;
                    $turnoDetail->price = $surtidor->product->price;
                    $turnoDetail->lectura_inicial = $surtidor->lectura_actual;
                    $turnoDetail->lectura_final = 0.0;

                    $turno_Details[] = $turnoDetail;
                }
            }
            else
            {
               // dd($turno_Details);
            }

        }else{

            $turno_Details = [];
            foreach($surtidores as $surtidor){
                $turnoDetail = new TurnoDetail();
                $turnoDetail->turno_id = NULL;
                $turnoDetail->surtidor_id = $surtidor->id;
                $turnoDetail->price = $surtidor->product->price;
                $turnoDetail->lectura_inicial = $surtidor->lectura_actual;
                $turnoDetail->lectura_final = $surtidor->lectura_actual; //0.0;

                $turno_Details[] = $turnoDetail;
            }
        }
        return $turno_Details;

    }
    // Turno Nuevo
    public function turnonuevo()
    {
        $turno = Turno::latest()->first();

        if ($turno){
            //Hay turno, debo pasar datos para el siguiente
            $f = $turno->fecha;
            $t = $turno->turno;
            switch ($t) {
                case 'NOCHE':
                    $t = 'MAÑANA';
                    break;
                case 'MAÑANA':
                    $t = 'TARDE';
                    break;
                case 'TARDE':
                    $t = 'NOCHE';

                    // Agrega un día a la fecha
                    $f = date('Y-m-d', strtotime($f . ' +1 day'));

                    break;
            }

            $turno->fecha = $f ;
            $turno->turno = $t;
            //dd($turno);
        }
        else{
            //No hay turnos en la BD, debo crear uno nuevo en base a la fecha y hora
            $turno = new Turno();
            $turno->turno = $this->asignarTurno();
            $turno->fecha = $this->asignarFechaSistema();
            $turno->user_id = auth()->user()->id;
            $turno->efectivo = 0;
            $turno->ctacte = 0;
            $turno->visa = 0;
            $turno->electron = 0;
            $turno->maestro = 0;
            $turno->mastercard = 0;
            $turno->american = 0;
            $turno->cheques = 0;
            $turno->otros = 0;
        }

        return view('user.turnonuevo')->with(compact('turno'));
    }
    // Total de litros en el turno
    public function total_litros($id){
        $lecturas = TurnoDetail::where('turno_id',$id)->get();
        $litros = 0;
        foreach($lecturas as $lectura){
            $litros = $litros +$lectura->lectura_final - $lectura->lectura_inicial;
        }
        return $litros;

    }

    //Importe total en el turno
    public function importe_total($id){
        $importes = TurnoDetail::where('turno_id',$id)->get();

        $importeturno = 0;
        foreach($importes as $importe){
            $litros = $importe->lectura_final - $importe->lectura_inicial;
           // dd($litros);
            $total = $litros * $importe->price;
            $importeturno = $importeturno + $total;
        }
       // dd($importeturno);
        return $importeturno;

    }

    //Edit Aforadores
    public function editaforadores($id){
        // Obtener el turno y validar su existencia
        $turno = Turno::find($id);
        $userRole = auth()->user()->role;
        $notification = "";

        if (!$turno) {
            $notification = "No existen aforadores a visualizar para el turno";
        } elseif ($turno->status && $userRole !== 'admin') {
            $notification = "El turno se encuentra cerrado!!";
        }

        // Obtener los detalles del turno y calcular los totales solo si el turno existe
        $turnoDetails = $turno ? $turno->turnoDetails : collect();
        $totales = [
            'litros' => $turno ? number_format($this->total_litros($turno->id), 2) : '0.00',
            'importe' => $turno ? number_format($this->importe_total($turno->id), 2) : '0.00',
        ];

        return view('user.editaforadores',compact('turno','totales','turnoDetails','notification'));
    }

    // Crear Turno o actualizar el turno existente
    public function crearturno(Request $request){

        $mensajes = [
            'efectivo.required' => 'El campo efectivo es obligatorio.',
            'efectivo.numeric' => 'El campo efectivo debe ser un número.',
            'efectivo.min' => 'El campo efectivo debe ser mayor o igual a cero.',
            'ctacte.required' => 'El campo ctacte es obligatorio.',
            'ctacte.numeric' => 'El campo ctacte debe ser un número.',
            'ctacte.min' => 'El campo ctacte debe ser mayor o igual a cero.',
            'visa.required' => 'El campo visa es obligatorio.',
            'visa.numeric' => 'El campo visa debe ser un número.',
            'visa.min' => 'El campo visa debe ser mayor o igual a cero.',
            'electron.required' => 'El campo electron es obligatorio.',
            'electron.numeric' => 'El campo electron debe ser un número.',
            'electron.min' => 'El campo electron debe ser mayor o igual a cero.',
            'maestro.required' => 'El campo maestro es obligatorio.',
            'maestro.numeric' => 'El campo maestro debe ser un número.',
            'maestro.min' => 'El campo maestro debe ser mayor o igual a cero.',
            'mastercard.required' => 'El campo mastercard es obligatorio.',
            'mastercard.numeric' => 'El campo mastercard debe ser un número.',
            'mastercard.min' => 'El campo mastercard debe ser mayor o igual a cero.',
            'american.required' => 'El campo american es obligatorio.',
            'american.numeric' => 'El campo american debe ser un número.',
            'american.min' => 'El campo american debe ser mayor o igual a cero.',
            'cheques.required' => 'El campo cheques es obligatorio.',
            'cheques.numeric' => 'El campo cheques debe ser un número.',
            'cheques.min' => 'El campo cheques debe ser mayor o igual a cero.',
            'otros.required' => 'El campo otros es obligatorio.',
            'otros.numeric' => 'El campo otros debe ser un número.',
            'otros.min' => 'El campo otros debe ser mayor o igual a cero.',
            // Agrega otros mensajes personalizados aquí según tus necesidades
        ];
        $request->validate([
            'efectivo' => 'required|numeric|min:0',
            'ctacte' => 'required|numeric|min:0',
            'visa' => 'required|numeric|min:0',
            'electron' => 'required|numeric|min:0',
            'maestro' => 'required|numeric|min:0',
            'mastercard' => 'required|numeric|min:0',
            'american' => 'required|numeric|min:0',
            'cheques' => 'required|numeric|min:0',
            'otros' => 'required|numeric|min:0',
            // Agrega otras reglas de validación si es necesario
        ], $mensajes);

        // Verificar que no exista el turno

        $fecha = $request->input('fecha');
        $turno = $request->input('turno');
        $comments = $request->input('comments');
        $turnonuevo = Turno::where('fecha',$fecha)->where('turno',$turno)->get();

        if (count($turnonuevo)==0)
        {
            // Como no hay turno, se procede a crear uno nuevo
            $turnonuevo->id = NULL;
            $turnonuevo->turno = $turno;
            $turnonuevo->fecha = $fecha;
            //Como no hay turno, crear el detalle con los valores del surtidor

            $turnoDetails = $this->detallesdelturno(NULL);

            $totales = array(
                'litros' => 0,
                'importe' => 0,
            );
            return view('user.aforadores')->with(compact('turnonuevo','turnoDetails','totales'));

        }else{
            //Actualizar Turno
            if ($request->input('id')){
                $turnonuevo = Turno::find($request->input('id'));
                $turnonuevo->fecha = $request->input('fecha');
                $turnonuevo->turno = $request->input('turno');
                $turnonuevo->efectivo = $request->input('efectivo');
                $turnonuevo->ctacte = $request->input('ctacte');
                $turnonuevo->visa = $request->input('visa');
                $turnonuevo->electron = $request->input('electron');
                $turnonuevo->maestro = $request->input('maestro');
                $turnonuevo->mastercard = $request->input('mastercard');
                $turnonuevo->american = $request->input('american');
                $turnonuevo->cheques = $request->input('cheques');
                $turnonuevo->otros = $request->input('otros');
                $turnonuevo->save();

                $turnoDetails = $this->detallesdelturno($turnonuevo->id);

                $totales = array(
                    'litros' => $this->total_litros($turnonuevo->id),
                    'importe' => $this->importe_total($turnonuevo->id),
                );

                return redirect('/home');
            }else{
                //Verificar s
                $ultimoturno = Turno::latest()->first();
                if ($ultimoturno->turno== $turno){
                    //Es un turno nuevo
                    $turnonuevo->id = NULL;
                    $turnonuevo->turno = $turno;
                    $turnonuevo->fecha = $fecha;
                    //Como no hay turno, crear el detalle con los valores del surtidor

                    $turnoDetails = $this->detallesdelturno(NULL);

                    $totales = array(
                        'litros' => 0,
                        'importe' => 0,
                    );
                    return view('user.aforadores')->with(compact('turnonuevo','turnoDetails','totales'));
                }else{
                    $notification = 'No es posible crear el turno solicitado';
                    return redirect('/home')->with(['notification'=> $notification, 'success'=>true]);
                }

            }

        }
    }

    // Editar Turno
    public function editarturno($id){
        // Editar el Turno
        $turno = Turno::find($id);
        $notification = null;
        if (!$turno){
            $notification ="No existe un para visualizar !!";
            return view('user.turnoedit')->with(compact('turno', 'notification'));
        }

        if ($turno->status){
            $notification ="El turno ya se encuentra cerrado!!";

            return view('user.turnoedit')->with(compact('turno', 'notification'));
        }

        return view('user.turnoedit')->with(compact('turno', 'notification'));

    }

    public function lectura_actual_surtidor($id){
        $surtidor = Surtidor::find($id);
        return $surtidor->lectura_actual;

    }

    public function actualizar_lectura_surtidor($id, $lectura){

        $surtidor = Surtidor::find($id);
        $surtidor->lectura_actual = $lectura;

        $surtidor->save();
    }

    // Registrar los aforadores
    public function storeaforadores(Request $request){
        $fecha = $request->input('fecha');
        $turno = $request->input('turno');
        $user_id = auth()->user()->id;
        $turnonuevo = Turno::where('turno',$turno)->where('fecha',$fecha)->first();
        if (!$turnonuevo){
            // Es un nuevo turno
            $turnonuevo = new Turno();
            $turnonuevo->turno = $turno;
            $turnonuevo->fecha = $fecha;
            $turnonuevo->user_id = $user_id;
            $turnonuevo->save();

            //Se deberia registrar el detalle de aforadores y el actualizar las lecturas
            $surtidorIds = $request->input('surtidor_id');

            foreach ($request->input('l_final') as $key=>$item)
            {

                $detalle = new TurnoDetail();
                $detalle->turno_id = $turnonuevo->id;

                $detalle->surtidor_id =  $surtidorIds[$key];


                $detalle->lectura_inicial = $this->lectura_actual_surtidor($detalle->surtidor_id);
                $detalle->lectura_final = $item;
                $arrprice = $request->input('price');
                $detalle->price = $arrprice[$key];
                $detalle->save();

                // Actualizar la lectura del surtidor
                //$this->actualizar_lectura_surtidor($detalle->surtidor_id, $detalle->lectura_final);
            }
        }else   //el turno ya existe
        {
            $lecturas = $request->input('l_final');         // Son las lecturas de cada surtidor

            $surtidores = $request->input('surtidor_id');   //array con los id de surdores

            $prices = $request->input('price');             //Array con los precios

            foreach ($lecturas as $key=> $lectura )
            //foreach ($surtidors as $key=> $surtidor)
            {
                // Registrar el detalle
                $detalle = TurnoDetail::where('turno_id',$turnonuevo->id)->where('surtidor_id',  $surtidores[$key])->first();

                if (!$detalle->lectura_inicial){

                    $detalle->lectura_inicial = $this->lectura_actual_surtidor($surtidores[$key]);
                }

                $detalle->lectura_final = $lecturas[$key];
                $detalle->price=$prices[$key];
                if ($detalle->lectura_final < $detalle->lectura_inicial )
                {
                    $notification = 'La lectura final debe ser mayor o igual a la lectura inicial';
                    return back()->with(compact('notification'));
                }

                $detalle->save();

            }
        }
        // Se llama a la edición para registrar los importes del turno
        //
         return redirect('/home');
        //return redirect('/user/turno/edit/'.$turnonuevo->id);
      //   return redirect('/home');
    }

    public function cerrarturno($id){
        $turno = Turno::findOrFail($id);
        return view('user.cerrarturno')->with(compact('turno'));

    }

    public function confirmarcierreturno(Request $request){
        $turno = Turno::findOrFail($request->input('id'));
        //$turno = Turno::findOrFail($request->input('id'));
        $turno->status = True;
        $id = $turno->id;
        // Actualizar la lectura del surtidor
        //$detalle = TurnoDetail::where('turno_id', $id)->get();
        $detalles = $turno->turnoDetails;
        foreach ($detalles as $detalle) {

            $this->actualizar_lectura_surtidor($detalle->surtidor_id, $detalle->lectura_final);
        }
        $turno->save();
        $notification = "El turno se ha cerrado Satisfactoriamente!!";


        //$url = '/user/turno/cierres/pdf/'.$id;
        return redirect('home')->with(compact('notification'));

        //return redirect($url)->with(compact('id'));
    }

    public function calcularTotalLitros($id, $detalles){
        $litros = 0;
        foreach($detalles as $detalle){
           if ($detalle->surtidor->tanque->id == $id){
            //sumar
            $litros = $litros + $detalle->lectura_final - $detalle->lectura_inicial;
           }
        }

        return $litros;

    }

    public function total_por_tanques($detalles){

        $tanques = Tanque::all();
        foreach ($tanques as $tanque) {
            // Asigna el valor de total_litros a cada tanque.
            // Aquí puedes usar una función o algún cálculo específico para determinar el valor de total_litros.

            $tanque->total_litros = $this->calcularTotalLitros($tanque->id, $detalles);

        }
       return $tanques;

    }

    public function cierreAforadoresPDF($id)
    {
        $empresa = "LAS LOMAS SRL";
        $detalles = turnoDetail::where('turno_id', $id)->get();         //   Data::all(); // Reemplaza con la consulta que necesites
        $turno = turno::find($id);                                      //   Data::all(); // Reemplaza con la consulta que necesites
        $totallitros = $this->total_litros($id);                        //  Total de Listros
        $importetotal = $this->importe_total($id);
        $total_tanques = $this->total_por_tanques($detalles);
        // Obtener la fecha y hora actual
        $currentDateTime = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = PDF::loadView('user.pdfCierres', compact('turno', 'detalles', 'totallitros', 'importetotal', 'total_tanques', 'currentDateTime', 'empresa'));

        // Guarda el PDF temporalmente en el servidor
        $rptname = 'app/public/cierres/turno_'.$id.'.pdf';
        $pdfPath = storage_path($rptname);
        //$pdf->save($pdfPath);
        return $pdf->stream('reporte.pdf');


        return redirect('/home');
    }

}
