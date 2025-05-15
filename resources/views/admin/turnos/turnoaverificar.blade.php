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
                                    <input type="checkbox" name="seleccionar[]" value="{{ $dato['surtidor_id'] }}"
                                        checked>
                                    <!-- Hidden fields to send all data -->
                                    <input type="hidden" name="datos[{{ $index }}][id]"
                                        value="{{ $dato['id'] }}">
                                    <input type="hidden" name="datos[{{ $index }}][turno]"
                                        value="{{ $dato['turno'] }}">
                                    <input type="hidden" name="datos[{{ $index }}][fecha]"
                                        value="{{ $dato['fecha'] }}">
                                    <input type="hidden" name="datos[{{ $index }}][surtidor_id]"
                                        value="{{ $dato['surtidor_id'] }}">
                                    <input type="hidden" name="datos[{{ $index }}][lectura_amodificar]"
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


    </div>

</div>

@include('includes.footer')
@endsection
