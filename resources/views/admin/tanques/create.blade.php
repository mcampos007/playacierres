@extends('layouts.app')

@section('title', 'Registro de un nuevo producto')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Registrar Nuevo Tanque</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('tanques.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row mb-3">

                        <div class="col-sm-4">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>

                        <div class="col-sm-4">
                            <label for="product_id" class="col-sm-2 col-form-label">Producto</label>
                            <select class="form-control" aria-label="Default select example" name="product_id">
                                <option selected>Seleccione un producto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="capacidad" class="col-sm-2 col-form-label">capacidad (Lts.)</label>
                                <input type="text" class="form-control" id="capacidad" name="capacidad">
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Tanque</button>
                    <a href=" {{ route('tanques.index') }}" class="btn btn-default">Cancelar</a>
                </form>

            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection
