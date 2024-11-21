@extends('layouts.app')

@section('title', 'Registro de los Aforadores')

@section('body-class', 'product-page')


@section('content')
    <div class="header header-filter"
        style="background-image: url( '{{ asset('img/demofondo.jpg') }})'; background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section ">
                <h2 class="title text-center">Actualizar Aforadores - Turno: {{ $turno->turno }} - Fecha: {{ $turno->fecha }}
                </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($notification)
                    <div class="alert alert-danger">
                        {{ $notification }}
                    </div>
                @endif
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'user')
                    <form method="post" action="{{ route('aforadores') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="fecha" value="{{ $turno->fecha }}" />
                        <input type="hidden" name="turno" value = "{{ $turno->turno }}" />
                        <input type="hidden" name="id" id="id" value="{{ $turno->id }}">
                        <input type="hidden" name="cantsurtidores" id="cantsurtidores" value="{{ count($turnoDetails) }}">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Manguera</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Lectura Inicial</th>
                                        <th class="text-center">Lectura Final</th>
                                        <th class="text-center">Litros</th>
                                        <th class="text-center">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($turnoDetails as $key => $Detail)
                                        <tr>
                                            <input type="hidden" name="surtidor_id[]" value="{{ $key + 1 }}" />
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $Detail->surtidor->name }}</td>
                                            <td class="text-center">{{ $Detail->surtidor->product->name }}</td>
                                            <td class="text-center">
                                                <input type="number" value="{{ $Detail->surtidor->product->price }}"
                                                    name="price[]" id="price_{{ $key + 1 }}" readonly
                                                    style="width: 80px;" />
                                            </td>
                                            <!-- Lectura Inicial -->
                                            <td class="text-center">
                                                <input type="number" value="{{ $Detail->lectura_inicial }}"
                                                    name="l_inicial_{{ $key + 1 }}"
                                                    id="l_inicial_{{ $key + 1 }}" disabled style="width: 100px;" />
                                            </td>
                                            <!-- Lectura Actual -->
                                            <td class="text-center">
                                                <input type="number" name="l_final[]" id="l_final_{{ $key + 1 }}"
                                                    step="0.01" value= "{{ old('l_final[]', $Detail->lectura_final) }}"
                                                    onchange="recalculateImporte({{ $key + 1 }}) "
                                                    style="width: 120px;"
                                                    {{ $turno->status && auth()->user()->role === 'user' ? 'disabled' : '' }} />
                                            </td>
                                            <!-- Litros -->
                                            <td class="text-center">
                                                <input type="number" name="litros_{{ $key + 1 }}"
                                                    id="litros_{{ $key + 1 }}" step="0.01" value= "0.00" disabled
                                                    style="width: 100px;" />
                                            </td>
                                            <!-- Importe -->
                                            <td class="text-center">
                                                <input type="number" id="importe_{{ $key + 1 }}" name="importe[]"
                                                    value = "{{ old('importe[]') }}" readonly style="width: 100px;" />
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6"></td>
                                        <td>
                                            <span class="label label-info" id="totallitros">Total Litros:
                                                {{ $totales['litros'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="label label-info" id="totalimporte">Total Importe:
                                                {{ $totales['importe'] }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-row ">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"
                                    {{ $turno->status && auth()->user()->role === 'user' ? 'disabled' : '' }}>Actualizar
                                    Aforadores</button>
                                <a href="{{ url('/home') }}" class="btn btn-default">Cancelar</a>
                            </div>

                        </div>
                    </form>
                @endif


            </div>

        </div>

    </div>

    @include('includes.footer')
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calculaTotales() {
        var vCantSurtidores = parseFloat(document.getElementById('cantsurtidores').value);
        var surtidoresArray = Array(vCantSurtidores);
        var vTotalLitros = 0;
        var vLitros = 0
        var vImporteTotal = 0;

        for (var i = 1; i <= vCantSurtidores; i++) {
            var l_finalValue = parseFloat(document.getElementById('l_final_' + i).value);
            var l_inicialValue = parseFloat(document.getElementById('l_inicial_' + i).value);
            var priceValue = parseFloat(document.getElementById('price_' + i).value);
            vLitros = l_finalValue - l_inicialValue
            vTotalLitros = vTotalLitros + vLitros
            vImporteTotal = vImporteTotal + vLitros * priceValue;


        }

        $('#totallitros').text('Total Litros: ' + vTotalLitros.toFixed(2));
        $('#totalimporte').text('Total Importe: ' + vImporteTotal.toFixed(2));

    }

    function recalculateImporte(key) {
        let l_finalValue = parseFloat(document.getElementById('l_final_' + key).value);
        let l_inicialValue = parseFloat(document.getElementById('l_inicial_' + key).value);
        let priceValue = parseFloat(document.getElementById('price_' + key)
            .value); // Asegúrate de tener un elemento con el ID 'price' que contenga el valor de price

        let importe = (l_finalValue - l_inicialValue) *
            priceValue; // Aquí puedes cambiar '0' si deseas restar otro valor
        let litros = (l_finalValue - l_inicialValue); // Los litros despachados

        if (litros < 0) {
            Swal.fire({
                icon: "error",
                title: "Revise el valor ingresado...",
                text: "No se pueden ingresar lecturas inferiores a la actual ",

            });
            litros = 0
            importe = 0
            document.getElementById('l_final_' + key).value = l_inicialValue

        }

        document.getElementById('importe_' + key).value = importe.toFixed(2);
        document.getElementById('litros_' + key).value = litros.toFixed(2);

        calculaTotales();


    }
</script>


@foreach ($turnoDetails as $key => $turnoDetail)
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            // Aquí colocas tu código JavaScript
            let l_finalValue = parseFloat(document.getElementById('l_final_{{ $key + 1 }}').value);
            let l_inicialValue = parseFloat(document.getElementById('l_inicial_{{ $key + 1 }}').value);
            let priceValue = parseFloat(document.getElementById('price_{{ $key + 1 }}')
                .value); // Asegúrate de tener un elemento con el ID 'price' que contenga el valor de price

            let importe = (l_finalValue - l_inicialValue) *
                priceValue; // Aquí puedes cambiar '0' si deseas restar otro valor
            let litros = (l_finalValue - l_inicialValue); // Los litros despachados


            document.getElementById('importe_{{ $key + 1 }}').value = importe.toFixed(2);
            document.getElementById('litros_{{ $key + 1 }}').value = litros.toFixed(2)

        });
    </script>
@endforeach
