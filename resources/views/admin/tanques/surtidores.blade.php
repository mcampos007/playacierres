@extends('layouts.app')

@section('title', 'Surtidores por Tanque')
@section('styles')

@endsection

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Surtidores del Tanque: {{ $tanque->nombre }} </h2>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="info">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>

                @if (session()->has('msj'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:!!</strong>{{ session('msj') }}
                    </div>
                @endif

                <div class="team">

                    <div class="row ">
                        {{-- <a href="{{ route('tanques.create') }}" class="btn btn-primary btn-round"> Nuevo Tanque</a> --}}
                        {{-- <table class="table-responsive table-hover"> --}}
                        @php
                            $rowClasses = [
                                'row-color-1',
                                'row-color-2',
                                'row-color-3',
                                'row-color-4',
                                'row-color-5',
                                'row-color-6',
                                'row-color-7',
                                'row-color-8',
                            ];
                        @endphp
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-1 text-center">#</th>
                                    <th class="col-md-3 text-center">Surtidor</th>
                                    <th class="col-md-3 text-center">Producto</th>
                                    <th class="col-md-3  text-center">Opciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surtidores as $index => $surtidor)
                                    <tr>
                                        <td>
                                            {{ $surtidor->id }}
                                        </td>
                                        <td>
                                            {{ $surtidor->name }}
                                        </td>
                                        <td>
                                            {{ $surtidor->product->name }}
                                        </td>
                                        <td class="td-actions text-center">
                                            <form method="post"
                                                action="{{ route('tanques.surtidores.destroy', $tanque->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href=" {{ route('admin.surtidors.changetanque', ['id' => $surtidor->id]) }}"
                                                    type="button" rel="tooltip" title="Cambiar de Tanque"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="submit" rel="tooltip" title="Quitar del Tanque"
                                                    class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('tanques.index') }}" class="btn btn-primary btn-round"> Volver a Tanques</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
@section('scripts')

@endsection
