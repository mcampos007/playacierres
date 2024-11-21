@extends('layouts.app')

@section('title','Registro de Turno Nuevo')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url( '{{ asset("img/demofondo.jpg") }})'; background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nueva Turno</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(auth()->user()->role=="user")
                <form method="post" action="{{ url('user/turnonuevo') }}" enctype="multipart/form-data">
                    {{csrf_field() }}  
                    <input type="hidden" name="efectivo" value = "0">
                    <input type="hidden" name="ctacte" value = "0">
                    <input type="hidden" name="visa" value = "0">
                    <input type="hidden" name="electron" value = "0">
                    <input type="hidden" name="maestro" value = "0">
                    <input type="hidden" name="mastercard" value = "0">
                    <input type="hidden" name="american" value = "0">
                    <input type="hidden" name="cheques" value = "0">
                    <input type="hidden" name="otros" value = "0">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="date" >Fecha</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker " placeholder="Seleccionar Fecha" 
                            name="fecha"
                            id="date" type="text" value="{{ old('fecha', $turno->fecha ?? date('Y-m-d')) }}" 
                            data-date-format="yyyy-mm-dd" 
                            data-date-start-date="{{ date('Y-m-d') }}"  
                            data-date-end-date="+30d"
                            required>
                        </div>
                        <div class="col-md-12">
                            <label for="turno">Turno</label>
                            <select name="turno" id="turno">
                                <option value="NOCHE" {{ (old('turno') ?? $turno->turno) === 'NOCHE' ? 'selected' : '' }}>Noche</option>
                                <option value="MAÑANA" {{ (old('turno') ?? $turno->turno) === 'MAÑANA' ? 'selected' : '' }}>Mañana</option>
                                <option value="TARDE" {{ (old('turno') ?? $turno->turno) === 'TARDE' ? 'selected' : '' }}>Tarde</option>
                            </select>
                        </div>
                    </div>  

                   <div class="form-row ">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Registrar Aforadores</button>
                            <a href="{{ url('/home') }}" class="btn btn-default">Cancelar</a>
                        </div>
                   </div>       
                </form>
            @endif


        </div>

    </div>

</div>

@include('includes.footer')
@endsection
