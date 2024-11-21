@extends('layouts.app')

@section('title', 'Creación de Usuarios')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Crear Nuevo Usuario</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:!!</strong>{{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-info">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                <form method="post" action="{{ url('admin/user') }}" enctype="multipart/form-data" class="text-center">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del Usuario</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">email</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Password Confirm</label>
                                <input type="password" class="form-control" name="passwordconfirm"
                                    value="{{ old('passwordconfirm') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row text-left">
                        <label class="control-label">Rol:</label>
                        <select class="form-select" aria-label="Default select example" id="role" name="role">

                            <option value="admin">admin</option>
                            <option value="user" selected>user</option>

                        </select>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
            <a href=" {{ route('user.index') }}" class="btn btn-default">Regresar</a>
            </form>

        </div>

    </div>

    </div>

    @include('includes.footer')
@endsection
