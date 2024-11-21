@extends('layouts.app')

@section('title', 'Editar el Turno Seleccionado')

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
                    <h2 class="title text-center">Editar Turno</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('updateturno', ['id' => $turno->id]) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" value={{ $turno->user_id }} name="user_id">
                        @method('PUT')
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
                                    <label for="efectivo">Efectivo</label>
                                    <input type="number" class="form-control" name="efectivo" step="0.01"
                                        id="efectivo" value="{{ old('efectivo', $turno->efectivo) }}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="ctacte">Cuenta Corriente</label>
                                    <input type="number" class="form-control" name="ctacte" step="0.01"
                                        id="ctacte" value="{{ old('ctacte', $turno->ctacte) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="visa">Visa</label>
                                    <input type="number" class="form-control" name="visa" step="0.01"
                                        id="visa" value="{{ old('visa', $turno->visa) }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="electron">Visa electron</label>
                                    <input type="number" class="form-control" name="electron" step="0.01"
                                        id="electron" value="{{ old('electron', $turno->electron) }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="maestro">Maestro</label>
                                    <input type="number" class="form-control" name="maestro" step="0.01"
                                        id="maestro" value="{{ old('maestro', $turno->maestro) }}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="mastercard">Master Card
                                        <input type="number" class="form-control" name="mastercard" step="0.01"
                                            id="mastercard" value="{{ old('mastercard', $turno->mastercard) }}">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="american">American</label>
                                    <input type="number" class="form-control" name="american" step="0.01"
                                        id="american" value="{{ old('american', $turno->american) }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="cheques">Cheques</label>
                                    <input type="number" class="form-control" name="cheques" step="0.01"
                                        id="cheques" value="{{ old('cheques', $turno->cheques) }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <label for="otros">Otros</label>
                                    <input type="number" class="form-control" name="otros" step="0.01"
                                        id="otros" value="{{ old('otros', $turno->otros) }}">
                                </div>
                            </div>


                        </div>

                        <div class="form-row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar Turno</button>
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
