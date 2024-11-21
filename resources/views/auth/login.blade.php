@extends('layouts.app')

@section('body-class', 'signup-page')
@section('styles')
    .footer {
    background-color: #343a40;
    color: #ffffff;
    }
    .footer a {
    color: #ffffff;
    text-decoration: none;
    }
    .footer a:hover {
    color: #f8d7da;
    text-decoration: underline;
    }
    .footer .laravel-version {
    font-size: 0.85rem;
    margin-top: 5px;
    }
@endsection

@section('content')
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-signup">
                        <form class="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="header header-primary text-center">
                                <h4>Inicio de Sesión</h4>
                                <div class="social-line">
                                    <!--
                                                                <a href="#" class="btn btn-simple btn-just-icon">
                                                                    <i class="fa fa-facebook-square"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-simple btn-just-icon">
                                                                    <i class="fa fa-twitter"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-simple btn-just-icon">
                                                                    <i class="fa fa-google-plus"></i>
                                                                </a>
                                                            -->
                                </div>
                            </div>
                            <p class="text-divider">Ingresa tus datos</p>
                            <div class="content">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <input id="email" type="email" class="form-control" placeholder="Email..."
                                        name="email" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="Password..."required>
                                </div>

                                <!-- If you want to add a checkbox to this form, uncomment this code -->

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Recordar sesión
                                    </label>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-lg"> Ingresar </button>
                                <a class="btn btn-simple btn-danger btn-lg" href="{{ route('password.request') }}">
                                    Olvidaste tu clave?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer')

    </div>
@endsection
