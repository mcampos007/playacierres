@extends('layouts.app')

@section('title', 'Listado de Tanques')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Tanques </h2>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="info">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>

                <div class="team">
                    @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:!!</strong>{{ session('msj') }}
                        </div>
                    @endif
                    <div class="row ">
                        <a href="{{ route('tanques.create') }}" class="btn btn-primary btn-round"> Nuevo Tanque</a>
                        <table class="table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="col-md-2 text-center">Nombre</th>
                                    <th class="col-md-2 text-center">Capacidad</th>
                                    <th class="col-md-2 text-center">Producto</th>
                                    <th class="col-md-2">Opciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tanques as $tanque)
                                    <tr>
                                        <td class="text-center">{{ $tanque->id }}</td>
                                        <td class="text-center">{{ $tanque->nombre }}</td>
                                        <td class="text-center">{{ $tanque->capacidad }}</td>
                                        <td class="text-center">{{ $tanque->product?->name ?? 'Sin producto' }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ route('tanques.destroy', $tanque->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href=" {{ route('tanques.edit', $tanque->id) }}" type="button"
                                                    rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href=" {{ route('tanques.surtidores', ['id' => $tanque->id]) }}"
                                                    type="button" rel="tooltip" title="Surtdores del Tanque"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="material-icons">local_gas_station</i>
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

                    </div>

                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
