<x-layouts.app :title="__('Home')">
     <div class="p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Catálogo de Productos</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($productos as $producto)
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $producto->imagen_url }}" alt="Imagen {{ $producto->nombre }}" class="w-16 h-16 object-cover rounded">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $producto->nombre }}</h2>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $producto-> descripción }}</p>
                        <td class="border border-gray-300 dark:border-neutral-600 px-4 py-2">${{ number_format($producto->precio_unitario, 2) }}</td>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">No hay productos disponibles.</p>
            @endforelse
            <form action="{{ route('productos.solicitar', $producto->id) }}" method="POST">
    @csrf
    <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded">Solicitar Renta</button>
</form>
        </div>
    </div>

    <a href="https://wa.me/524881109516" target="_blank"
   class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600">
    Escribenos por WhatsApp
</a>
</x-layouts.app>
