<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Bodega</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 20px; }
        .section h2 { margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Bodega</h1>
        <p><strong>Nombre:</strong> {{ $bodega->nombre }}</p>
        <p><strong>Ubicación:</strong> {{ $bodega->ubicación }}</p>
        <p><strong>Responsable:</strong> {{ $bodega->responsable->name }}</p>
    </div>
    <div class="section">
        <h2>Productos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($bodega->inventario) && is_iterable($bodega->inventario))
                    @foreach ($bodega->inventario as $item)
                        <tr>
                            <td>{{ $item->producto->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No hay productos disponibles.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
