@extends('layouts.app')

@section('title', 'Modificación de Surtidor')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Datos para el Nuevo surtidor </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif


                </div>

                <div class="team">
                    @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:!!</strong>{{ session('msj') }}
                        </div>
                    @endif

                    <div class="container">
                        <h1>Datos del Surtidor</h1>
                        <form method="POST" action="{{ route('admin.surtidors') }}">
                            @csrf


                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $surtidor->name }}">
                            </div>

                            <div class="form-group">
                                <label for="producto">Producto:</label>
                                <select name="product_id" id="producto" class="form-control">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lectura_actual">Lectura Actual:</label>
                                <input type="text" name="lectura_actual" id="lectura_actual" class="form-control"
                                    value="{{ $surtidor->lectura_actual }} ">
                            </div>

                            <!-- Agrega más campos aquí según tus necesidades -->

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
