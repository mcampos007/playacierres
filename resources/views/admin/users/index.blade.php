@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de Usuarios </h2>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif

                </div>

                <div class="team">
                    @if (session()->has('msj') || session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:!!</strong>{{ session('msj') }}{{ session('error') }}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="success">
                            <strong></strong>{{ session('success') }}
                        </div>
                    @endif
                    <div class="row ">
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-round">
                            @else
                                <a href="#" class="btn btn-primary btn-round">
                        @endif
                        Nuevo Usuario</a>
                        <table class="table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-1 text-center">#</th>
                                    <th class="col-md-3 text-center">Nombre</th>
                                    <th class="col-md-3 text-center">email</th>
                                    <th class="col-md-2 text-center">Rol</th>
                                    <th class="col-md-2 text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td class="text-center">{{ $usuario->id }}</td>
                                        <td class="text-left">{{ $usuario->name }}</td>
                                        <td class="text-left">{{ $usuario->email }}</td>
                                        <td class="text-center">{{ $usuario->role }}</td>

                                        <td class="td-actions text-center">
                                            <form method="post"
                                                action="{{ route('user.destroy', ['id' => $usuario->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href=" {{ url('/admin/user/' . $usuario->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" rel="tooltip" title="Eliminar"
                                                    class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{ $usuarios->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
