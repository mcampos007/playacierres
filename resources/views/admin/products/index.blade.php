@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de Productos </h2>
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
                    <div class="row ">
                        @if (auth()->user()->role == 'admin')
                            {{-- <a href="{{ url('/admin/products/create')}}" class="btn btn-primary btn-round"> --}}
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-round">
                            @else
                                <a href="#" class="btn btn-primary btn-round">
                        @endif
                        Nuevo Producto</a>
                        <table class="table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="col-md-2 text-center">Producto</th>
                                    <th class="col-md-2 text-center">Precio</th>
                                    <th class="col-md-2 text-center">Estado</th>
                                    <th class="col-md-2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">{{ $product->price }}</td>
                                        <td class="text-center">{{ $product->status }}</td>

                                        <td class="td-actions text-right">
                                            <form method="post"
                                                action="{{ route('admin.product.delete', ['id' => $product->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href=" {{ url('/admin/products/' . $product->id . '/edit') }}"
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
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
