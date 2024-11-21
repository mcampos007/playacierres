@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-signup">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <p>¡Le hemos enviado por correo electrónico el enlace para restablecer su contraseña!</p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="header header-primary text-center">
                                <h4>Solicitar blanqueo de Password</h4>
                            </div>
                            <div class="content">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <input id="email" type="email" class="form-control" placeholder="Email..."
                                        name="email" value="{{ old('email') }}" required autofocus>
                                    {{-- @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>No podemos encontrar un usuario con esa dirección de correo
                                                electrónico.</strong>
                                        </span>
                                    @enderror --}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirmar') }}
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')

    </div>
@endsection
