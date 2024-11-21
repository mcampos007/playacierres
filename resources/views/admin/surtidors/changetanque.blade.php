@extends('layouts.app')

@section('title', 'Surtidores por Tanque')
@section('styles')

@endsection

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2>Cambiar el surtidor de tanque</h2>
                <form action="{{ route('admin.surtidors.updatetanque', ['id' => $surtidor->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="tanque">Seleccionar un Tanque:</label>
                    <select name="tanque_id" id="tanque_id" class="form-select" aria-label="Seleccion">
                        @foreach ($tanques as $tanque)
                            <option value="{{ $tanque->id }}">
                                {{ $tanque->nombre . ' - ' . $tanque->product->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>

                {{ $surtidor }}
            </div>
        </div>
    </div>


    @include('includes.footer')
@endsection
