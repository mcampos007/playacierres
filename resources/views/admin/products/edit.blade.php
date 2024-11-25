@extends('layouts.app')

@section('title', 'Edición de Products')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Editar Datos del Product</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('admin/products/' . $product->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio</label>
                                <input type="text" class="form-control" name="price"
                                    value="{{ old('price', $product->price) }}" min="0" step="0.01" required
                                    oninput="this.value = this.value < 0 ? '' : this.value"
                                    placeholder="Ingrese el precio del producto">

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    <a href=" {{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
                </form>

            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection
