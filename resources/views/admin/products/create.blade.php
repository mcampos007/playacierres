@extends('layouts.app')

@section('title', 'Registro de un nuevo producto')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo2.jpg') }}'); background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Registrar Nuevo Producto</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del Producto</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Producto</button>
                    <a href=" {{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
                </form>

            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection
