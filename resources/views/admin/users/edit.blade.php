@extends('layouts.app')

@section('title', 'Edición de Usuarios')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Editar Datos del Usuario</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-info">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                <form method="post" action="{{ route('user.update', ['id' => $usuario->id]) }}" enctype="multipart/form-data"
                    class="text-center">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del Usuario</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $usuario->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">email</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email', $usuario->email) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-2">
                            <label class="control-label">Rol:</label>
                            <select class="form-select" aria-label="Default select example" id="role" name="role">

                                <option value="admin" {{ $usuario->role === 'admin' ? 'selected' : '' }}>admin</option>
                                <option value="user" {{ $usuario->role === 'user' ? 'selected' : '' }}>user</option>

                            </select>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    <a href=" {{ route('user.index') }}" class="btn btn-default">Regresar</a>
                </form>

            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection
