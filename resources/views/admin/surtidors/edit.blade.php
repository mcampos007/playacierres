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
                <h2 class="title">Detalles del Surtidor {{ $surtidor->name }}</h2>
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
                        <h1>Actualizar Surtidor</h1>
                        <form method="POST" action="{{ route('admin.surtidors.update', ['id' => $surtidor->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $surtidor->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="producto">Producto:</label>
                                        <select name="producto" id="producto" class="form-control">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ $surtidor->product->id === $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">

                                    <label for="tanque_id" class="col-sm-2 col-form-label">Tanque</label>
                                    <select class="form-control" aria-label="Default select example" name="tanque_id">
                                        <option selected>Seleccione un Tanque</option>
                                        @foreach ($tanques as $tanque)
                                            <option value="{{ $tanque->id }}"
                                                {{ $surtidor->tanque_id === $tanque->id ? 'selected' : '' }}>
                                                {{ $tanque->nombre . ' - ' . $tanque->product->name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="lectura_actual">Lectura Actual:</label>
                                        <input type="text" name="lectura_actual" id="lectura_actual" class="form-control"
                                            value="{{ $surtidor->lectura_actual }} ">
                                    </div>
                                </div>
                            </div>




                            <!-- Agrega más campos aquí según tus necesidades -->

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
