@extends('layouts.app')

@section('title','Precios Actuales')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset("img/demofondo.jpg") }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Precios Actuales </h2>
            <div class="card-body">
                @if (session('notification'))
                
                <div class="alert alert-success" role="alert">
                  {{ session('notification')}}
                </div>
                @endif

              </div>

            <div class="team">
                @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('msj')}}
                        </div>
                    @endif
                <div class="row ">
                    <table class="table-responsive table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Producto</th>
                                <th class="col-md-2 text-center">Precio</th>
                                <th class="col-md-2 text-center">Estado</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                               <td class="text-center">{{ $product->name }}</td>
                               <td class="text-center">{{ $product->price }}</td>
                                <td class="text-center">
                                    @if ($product->status == 1)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
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
