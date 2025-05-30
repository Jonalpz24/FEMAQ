<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato #{{ $contrato->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Contrato #{{ $contrato->id }}</h2>
    <p><strong>Cliente:</strong> {{ $contrato->cliente->nombre }} {{ $contrato->cliente->apellido }}</p>
    <p><strong>Producto:</strong> {{ $contrato->producto->nombre }}</p>
    <p><strong>Cantidad:</strong> {{ $contrato->cantidad }}</p>
    <p><strong>Fecha:</strong> {{ $contrato->fecha_contrato }}</p>
    <p><strong>Total Costo:</strong> ${{ number_format($contrato->total_costo, 2) }}</p>
</body>
</html>
