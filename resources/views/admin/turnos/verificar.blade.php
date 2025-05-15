@extends('layouts.app')

@section('title', 'Verificar Turnos')
@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}' ); background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="profile-content">

            <div class="container">
                <div class="row">
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
                    @if ($notification = Session::get('notification'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ $notification }}</li>
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="{{ route('verificaraforador') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-4">
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

                                <div class="col-sm-4">
                                    <div class="form-group label-floating ">
                                        <label for="surtidor_id">Surtidor</label>
                                        <select name="surtidor_id" id="surtidor_id" readonly>
                                            <option value="">Seleccionar Surtidor</option>
                                            @foreach ($surtidores as $surtidor)
                                                <option value="{{ $surtidor->id }}"
                                                    {{ (old('surtidor_id') ?? $turno->surtidor_id) == $surtidor->id ? 'selected' : '' }}>
                                                    {{ $surtidor->name }}</option>
                                            @endforeach
                                        </select>

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
@endsection
