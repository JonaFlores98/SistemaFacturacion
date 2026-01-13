<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Electrónica</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        .box {
            border: 1px solid #000;
            padding: 6px;
            margin-bottom: 8px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
        }

        th {
            background: #f2f2f2;
        }

        .totales td {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .total-final {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 5px;
            text-align: center;
            font-size: 9px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- ENCABEZADO -->
    <div class="header">
        <h2>DOCUMENTO TRIBUTARIO ELECTRÓNICO</h2>
        <strong>{{ strtoupper($factura->tipo_documento) }}</strong>
        <p>N° {{ $factura->numero_factura }}</p>
    </div>

    <!-- EMISOR -->
    <div class="box">
        <strong>EMISOR</strong><br>
        Empresa: SISTEMA LOS PANAS<br>
        NIT: 0000-000000-000-0<br>
        Dirección: El Salvador<br>
    </div>

    <!-- RECEPTOR -->
    <div class="box">
        <strong>RECEPTOR</strong><br>
        Cliente: {{ $factura->cliente ?? 'Consumidor Final' }}<br>
        Fecha: {{ $factura->created_at->format('d/m/Y H:i') }}
    </div>

    <!-- DETALLE -->
    <table>
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th class="right">P. Unit</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($factura->detalles as $item)
            <tr>
                <td class="center">{{ $item->cantidad }}</td>
                <td>{{ $item->producto }}</td>
                <td class="right">${{ number_format($item->precio, 2) }}</td>
                <td class="right">${{ number_format($item->total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- TOTALES -->
    <table class="totales">
        <tr>
            <td>Subtotal</td>
            <td class="right">${{ number_format($factura->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td class="right">${{ number_format($factura->total, 2) }}</td>
        </tr>
    </table>

    <div class="total-final">
        TOTAL A PAGAR: ${{ number_format($factura->total, 2) }}
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Documento generado electrónicamente<br>
        Conforme a normativa de Hacienda - El Salvador
    </div>

</div>

</body>
</html>
