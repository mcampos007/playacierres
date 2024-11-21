@extends('layouts.app')

@section('title', 'Turno a Verificar')

@section('body-class', 'product-page')

@section('content')
@section('styles')
    <style>
        label {
            display: block;
            margin: 0.5rem 0;
        }
    </style>
@endsection
<div class="header header-filter"
    style="background-image: url( '{{ asset('img/demofondo.jpg') }})'; background-size: cover; background-position: top center;">
</div>


<div class="main main-raised">

    <div class="container">

        <div class="section section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title text-center">Turno a Verificar</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('actualizaraforador') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <input type="hidden" name="id" value="{{ $dato['turno_id'] }}"> --}}
                        <div class="container mt-5">
                            <h2 class="mb-4">Tabla de Lecturas a Modificar</h2>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Turno ID</th>
                                        <th>Turno</th>
                                        <th>Fecha</th>
                                        <th>Surtidor ID</th>
                                        <th>Lectura a Modificar</th>
                                        <th>Nueva Lectura</th>
                                        <th>Modificar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datosModificar as $index => $dato)
                                        <tr>
                                            <td>{{ $dato['id'] }}</td>
                                            <td>{{ $dato['turno'] }}</td>
                                            <td>{{ $dato['fecha'] }}</td>
                                            <td>{{ $dato['surtidor_id'] }}</td>
                                            <td>{{ $dato['lectura_amodificar'] }}</td>
                                            <td>{{ $dato['nueva_lectura'] }}</td>
                                            <td>
                                                <input type="checkbox" name="seleccionar[]"
                                                    value="{{ $dato['surtidor_id'] }}" checked>
                                                <!-- Hidden fields to send all data -->
                                                <input type="hidden" name="datos[{{ $index }}][id]"
                                                    value="{{ $dato['id'] }}">
                                                <input type="hidden" name="datos[{{ $index }}][turno]"
                                                    value="{{ $dato['turno'] }}">
                                                <input type="hidden" name="datos[{{ $index }}][fecha]"
                                                    value="{{ $dato['fecha'] }}">
                                                <input type="hidden" name="datos[{{ $index }}][surtidor_id]"
                                                    value="{{ $dato['surtidor_id'] }}">
                                                <input type="hidden"
                                                    name="datos[{{ $index }}][lectura_amodificar]"
                                                    value="{{ $dato['lectura_amodificar'] }}">
                                                <input type="hidden" name="datos[{{ $index }}][nueva_lectura]"
                                                    value="{{ $dato['nueva_lectura'] }}">

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar Aforador</button>
                                <a href="{{ route('admin.turnoscheck') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </form>
                    {{-- <form method="post" action="{{ route('actualizaraforador') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $turnoActual->id }}">

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="fecha">Fecha
                                        <input class="form-control datepicker" placeholder="Seleccionar Fecha"
                                            name="fecha" id="date" type="text"
                                            value="{{ old('fecha', $turnoActual->fecha) }}"
                                            data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}"
                                            data-date-end-date="+30d" required readonly>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="turno">Turno</label>
                                    <select name="turno" id="turno" readonly>
                                        <option value="NOCHE"
                                            {{ (old('turno') ?? $turnoActual->turno) === 'NOCHE' ? 'selected' : '' }}>
                                            Noche</option>
                                        <option value="MAÑANA"
                                            {{ (old('turno') ?? $turnoActual->turno) === 'MAÑANA' ? 'selected' : '' }}>
                                            Mañana</option>
                                        <option value="TARDE"
                                            {{ (old('turno') ?? $turnoActual->turno) === 'TARDE' ? 'selected' : '' }}>
                                            Tarde</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="surtidor">Surtidor</label>
                                    <input type="number" class="form-control" name="surtidor_id" step="1"
                                        id="surtidor_id"
                                        value="{{ $turnoActual->turnoDetails()->first()->surtidor_id }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="lecturaactual">Lectura Inicial Actual
                                        <input name="lecturaactual" id="lecturaactual" type="text"
                                            value="{{ old('lecturaactual', $turnoActual->turnoDetails()->first()->lectura_inicial) }}"
                                            required readonly>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="lecturapropuesta">Lectura Propuesta
                                        <input name="lecturapropuesta" id="lecturapropuesta" type="text"
                                            value="{{ old('lecturaprpuesta', $turnoAnterior->turnoDetails()->first()->lectura_final) }}"
                                            required>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar Aforador</button>
                                <a href="{{ route('admin.turnoscheck') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </form> --}}

                </div>
            </div>
        </div>

    </div>

</div>

@include('includes.footer')
@endsection
