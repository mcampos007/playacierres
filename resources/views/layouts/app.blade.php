<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title', config('app.name'))</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('css/material-kit.css') }}" rel="stylesheet" />

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @yield('styles')

</head>

<body class="@yield('body-class')">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="tab-pane active" id="studio">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name') }} </a>
                            <!--<a href="{{ url('/') }}">
                            <img src="{{ asset('img/logo2.jpeg') }}" alt="" class="float-right img-raised img-circle img-fluid"  width="150" height="150">
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}">Ingresar</a></li>
                        <li><a href="{{ route('register') }}">Registro</a></li>
                        <li><a href="{{ url('/precios') }}">Lista de Precios</a></li>
                    @else
                        @if (auth()->user()->role == 'admin')
                            @include('menus.menuadmin')
                        @endif
                        @if (auth()->user()->role == 'client')
                            @include('menus.menuclient')
                        @endif
                        @if (auth()->user()->role == 'user')
                            @include('menus.menuusuario')
                        @endif
                    @endguest
                    <!-- <li>
                        <a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-simple btn-white btn-just-icon">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li> -->
                </ul>
            </div>

        </div>

    </nav>



    <div class="wrapper">
        @yield('content')


    </div>
    <!-- <div class="team-player">
    <img src="{{ asset('img/logo1.jpg') }}" alt="Thumbnail Image" class="img-raised img-circle">

</div> -->

</body>
<!--   Core JS Files   -->
<script src=" {{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src=" {{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src=" {{ asset('js/material.min.js') }}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src=" {{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src=" {{ asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src=" {{ asset('js/material-kit.js') }}" type="text/javascript"></script>

<!-- Sweetalñert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')

</html>
