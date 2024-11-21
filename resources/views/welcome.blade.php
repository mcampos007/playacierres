@extends('layouts.app')
@section('title', 'Bienvenido a ' . config('app.name'))

@section('body-class', 'landing-page')

@section('styles')
    <style>
        .team .row .col-md-4 {
            margin-bottom: 5em;
        }

        .team .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -webkit-flexbox;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }

        .team .row>[class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .tt-query,
        /* UPDATE: newer versions use tt-input instead of tt-query */
        .tt-hint {
            width: 396px;
            height: 30px;
            padding: 8px 12px;
            font-size: 24px;
            line-height: 30px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
        }

        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
            color: #999
        }

        .tt-menu {
            /* used to be tt-dropdown-menu in older versions */
            width: 222px;
            margin-top: 4px;
            padding: 4px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

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
    </style>
@endsection
@section('content')
    <!--<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
        -->
    <div class="header header-filter"
        style="background-image: url(' {{ asset('img/demofondo.jpg') }}'); background-size: cover; background-position: top center;">

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h1 class="title">Bienvenido a {{ config('app.name') }}</h1>
                    <h4>¡Bienvenido al sistema de cierre de turnos en la estación de servicios!

                        Estamos aquí para hacer tu experiencia de cierre de turnos más fácil y eficiente. Nuestra plataforma
                        te brinda todas las herramientas necesarias para gestionar tus turnos de manera rápida y precisa.
                        Mantén un seguimiento de tus transacciones y realiza un balance preciso al final del día.</h4>
                    <br />


                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="container">
            <!-- <div class="section text-center section-landing">-->
            <!-- Notifiaciones -->
            @if (session('success'))
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
            @else
                @if (session('notification'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
            @endif

        </div>

        <div class="section landing-section">

        </div>
    </div>
    </div>

    @include('includes.footer')
@endsection

@section('scripts')
    <script src=" {{ asset('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            // Inicializar typeahead sobre nuestro input de busqueda
            var products = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                // `states` is an array of state names defined in "The Basics"
                prefetch: '{{ url('/products/json') }}'
            });

            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'products',
                source: products
            })
        });
    </script>
@endsection
