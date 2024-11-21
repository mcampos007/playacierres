@extends('layouts.app')

@section('title','Cerrar el Turno Seleccionado')

@section('body-class','product-page')

@section('content')
@section('styles')
   <style >
        label {
          display: block;
          margin: 0.5rem 0;
        }    
   </style> 
@endsection
<div class="header header-filter" style="background-image: url( '{{ asset("img/demofondo.jpg") }})'; background-size: cover; background-position: top center;">
</div>


<div class="main main-raised">

    <div class="container">

        <div class="section section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title text-center">Cerrar Turno</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->role=="user")
                        <form method="post" action="{{ url('user/turno/cerrarturno') }}" enctype="multipart/form-data">
                            {{csrf_field() }}
                            <input type="hidden" name="id" id="id" value="{{$turno->id}}">
                            <div class="alert alert-info">
                                <div class="container-fluid">
                                  <div class="alert-icon">
                                    <i class="material-icons">info_outline</i>
                                  </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                  </button>
                                  <b>Atención:</b> Está a punto de Cerrar el turno:{{$turno->turno }} con fecha {{$turno->fecha}}
                                </div>
                            </div>


                           <div class="form-row ">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Cerrar Turno</button>
                                    <a href="{{ url('/home') }}" class="btn btn-default">Cancelar</a>
                                </div>
                           </div>       
                        </form>
                    @endif 
                </div>       
            </div>
        </div>

    </div>

</div>

@include('includes.footer')
@endsection
