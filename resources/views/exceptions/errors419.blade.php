<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container text-center">
        <h1 class="display-3">419</h1>
        <p class="lead">Lo sentimos, tu sesión ha expirado. Por favor, actualiza y vuelve a intentarlo.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
    </div>
</body>

</html>
