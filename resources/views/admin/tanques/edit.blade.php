@extends('layouts.app')

@section('title', 'Editar datos del Tanque')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Editar Tanque</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('tanques.update', $tanque->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row mb-3">

                        <div class="col-sm-4">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ $tanque->nombre }}" />
                        </div>

                        <div class="col-sm-4">
                            <label for="product_id" class="col-sm-2 col-form-label">Producto</label>
                            <select class="form-control" aria-label="Default select example" name="product_id">
                                <option value="" {{ is_null($tanque->product) ? 'selected' : '' }}>Seleccione un
                                    producto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $tanque->product?->id === $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="capacidad" class="col-sm-2 col-form-label">capacidad (Lts.)</label>
                                <input type="text" class="form-control" id="capacidad" name="capacidad"
                                    value="{{ $tanque->capacidad }}">
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Tanque</button>
                    <a href=" {{ route('tanques.index') }}" class="btn btn-default">Cancelar</a>
                </form>

            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection
