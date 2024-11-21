<!DOCTYPE html>
<html>

<head>
    <title>Cierre de Turnos</title>
    <style>
        /* Agrega tus estilos aquí */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Tamaño de la fuente */
            margin: 10px;
            /* Ajusta este valor según tus necesidades */
        }

        h1 {
            font-size: 16px;
        }

        h3 {
            font-size: 10px;
            font-weight: bold;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Alineación específica para columnas */
        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        @page {
            margin-top: 5mm;
            /* Ajusta este valor según tus necesidades */
            margin-bottom: 5mm;
            /* Ajusta este valor según tus necesidades */
        }
    </style>
</head>

<body>
    <h1>PETRASOL SRL</h1>
    <h2>Cierre de Turno:{{ $turno->turno }} Fecha: {{ $turno->fecha }}</h2>
    <table>
        <thead>
            <tr>

                <th>Manguera</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>L. Inicial</th>
                <th>L. Final</th>
                <th>Litros</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $item)
                <tr>
                    <td>{{ $item->surtidor_id }}</td>
                    <td>{{ $item->surtidor->product->name }}</td>
                    <td class="text-right">{{ $item->price }}</td>
                    <td class="text-right">{{ $item->lectura_inicial }}</td>
                    <td class="text-right">{{ $item->lectura_final }}</td>
                    <td class="text-right">{{ round($item->lectura_final - $item->lectura_inicial, 2) }}</td>
                    <td class="text-right">
                        {{ round($item->price * ($item->lectura_final - $item->lectura_inicial), 2) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">{{ number_format($totallitros, 2) }}</td>
                <td class="text-right">{{ number_format($importetotal, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <h2>Resumen de Tanques</h2>
    <table>
        <thead>
            <tr>
                <th>Tanque</th>
                <th>Producto</th>
                <th>Litros</th>
                <th>Tanque</th>
                <th>Producto</th>
                <th>Litros</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_tanques->chunk(2) as $chunk)
                <tr>
                    @foreach ($chunk as $tanque)
                        <td> {{ $tanque->nombre }}</td>
                        <td>{{ $tanque->product->name }}</td>
                        <td class="text-right">{{ number_format($tanque->total_litros, 2) }}</td>
                    @endforeach
                    @if ($chunk->count() == 1)
                        <td colspan="3"></td> <!-- Empty cells if odd number of tanks -->
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Fecha y Hora <b><i>{{ $currentDateTime }}</i></b> - Responsable:{{ $turno->user->name }} </h3>
</body>

</html>
