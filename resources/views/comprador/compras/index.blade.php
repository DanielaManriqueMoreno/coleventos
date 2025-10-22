<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Historial de compras</h2>

    @if(session('message'))
        <p style="color:green">{{ session('message') }}</p>
    @endif

    @if($compras->isEmpty())
        <p>No has realizado compras aún.</p>
    @else
        <table border="1" cellpadding="5">
            <tr>
                <th>Evento</th>
                <th>Localidad</th>
                <th>Cantidad</th>
                <th>Valor total</th>
                <th>Fecha de compra</th>
                <th>Estado</th>
            </tr>
            @foreach($compras as $c)
            <tr>
                <td>{{ $c->evento->nombre }}</td>
                <td>{{ $c->localidad->nombre_localidad }}</td>
                <td>{{ $c->cantidad_boletas }}</td>
                <td>${{ $c->valor_total }}</td>
                <td>{{ $c->fecha_compra }}</td>
                <td>{{ $c->estado_transaccion }}</td>
            </tr>
            @endforeach
        </table>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
