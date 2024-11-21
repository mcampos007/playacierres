@extends('layouts.app')

@section('title', 'Verificar Turnos')

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

                    <form method="post" action="{{ route('verificaraforador') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="fecha">Fecha
                                        <input class="form-control datepicker" placeholder="Seleccionar Fecha"
                                            name="fecha" id="date" type="text"
                                            value="{{ old('fecha', $turno->fecha) }}" data-date-format="yyyy-mm-dd"
                                            data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d"
                                            required readonly>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="turno">Turno</label>
                                    <select name="turno" id="turno" readonly>
                                        <option value="NOCHE"
                                            {{ (old('turno') ?? $turno->turno) === 'NOCHE' ? 'selected' : '' }}>
                                            Noche</option>
                                        <option value="MAÑANA"
                                            {{ (old('turno') ?? $turno->turno) === 'MAÑANA' ? 'selected' : '' }}>
                                            Mañana</option>
                                        <option value="TARDE"
                                            {{ (old('turno') ?? $turno->turno) === 'TARDE' ? 'selected' : '' }}>
                                            Tarde</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="surtidor">Surtidor</label>
                                    <input type="number" class="form-control" name="surtidor_id" step="1"
                                        id="surtidor_id" value="{{ 'surtidor_id' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Verificar Aforador</button>
                                <a href="{{ url('/home') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

@include('includes.footer')
@endsection
