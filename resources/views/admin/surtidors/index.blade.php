@extends('layouts.app')

@section('title', 'Listado de Surtidores')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de Surtidores </h2>
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
                    @if (session()->has('success'))
                        <div class="alert alert-info" role="info">
                            <strong>Aviso:!!</strong>{{ session('success') }}
                        </div>
                    @endif
                    <div class="row ">
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.surtidors.create') }}" class="btn btn-primary btn-round">
                            @else
                                <a href="#" class="btn btn-primary btn-round">
                        @endif
                        Nuevo Surtidor</a>
                        <table class="table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="col-md-2 text-center">Nombre</th>
                                    <th class="col-md-2 text-center">Product</th>
                                    <th class="col-md-2 text-center">Tanque</th>
                                    <th class="col-md-2 text-center">Lectura Actual</th>
                                    <th class="col-md-2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surtidors as $surtidor)
                                    <tr>
                                        <td class="text-center">{{ $surtidor->id }}</td>
                                        <td class="text-center">{{ $surtidor->name }}</td>
                                        <td class="text-center">{{ $surtidor->product->name }}</td>
                                        <td class="text-center">
                                            {{ $surtidor->tanque ? $surtidor->tanque->nombre : 'No Definido' }}</td>

                                        <td class="text-center">{{ $surtidor->lectura_actual }}</td>

                                        <td class="td-actions text-right">
                                            <form method="post"
                                                action="{{ route('admin.surtidors.delete', ['id' => $surtidor->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href=" {{ route('admin.surtidors.edit', ['id' => $surtidor->id]) }}"
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
                            {{ $surtidors->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
