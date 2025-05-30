<h1>Solicitud de Renta</h1>
<p><strong>Producto:</strong> {{ $producto->nombre }}</p>
<p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
<p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
