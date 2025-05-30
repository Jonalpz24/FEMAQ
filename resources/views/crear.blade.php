<x-layouts.app :title="__('Añadir Producto')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Añadir Producto</h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/crear') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nombre del Producto
                </label>
                <input
                    type="text" id="nombre" name="nombre" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"
                >
            </div>
            <div class="mb-4">
                <label for="descripción" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Descripción
                </label>
                <textarea
                    id="descripción" name="descripción" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"
                ></textarea>
            </div>
            <div class="mb-4">
                <label for="unidad_medida" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Unidad de Medida
                </label>
                <select
                    id="unidad_medida" name="unidad_medida" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"
                >
                    <option value="PIEZA">PIEZA</option>
                    <option value="PAQUETE">PAQUETE</option>
                    <option value="KILO">KILO</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="precio_unitario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Precio Unitario
                </label>
                <input
                    type="number" id="precio_unitario" name="precio_unitario" step="0.01" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"
                >
            </div>
            <div class="mb-4">
                <label for="imagen_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    URL de la Imagen
                </label>
                <input
                    type="url" id="imagen_url" name="imagen_url"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"
                >
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Guardar
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mt-8 mb-4 text-gray-800 dark:text-gray-200">Productos existentes</h2>

        <table class="w-full border-collapse border border-gray-300 dark:border-neutral-600">
            <thead>
                <tr class="bg-gray-100 dark:bg-neutral-700">
                    <th class="border border-gray-300 dark:border-neutral-600 px-4 py-2 text-left">Imagen</th>
                    <th class="border border-gray-300 dark:border-neutral-600 px-4 py-2 text-left">Nombre</th>
                    <th class="border border-gray-300 dark:border-neutral-600 px-4 py-2 text-left">Precio</th>
                    <th class="border border-gray-300 dark:border-neutral-600 px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                    <td class="border border-gray-300 dark:border-neutral-600 px-4 py-2">
                        @if($producto->imagen_url)
                            <img src="{{ $producto->imagen_url }}" alt="Imagen {{ $producto->nombre }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400">Sin imagen</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 dark:border-neutral-600 px-4 py-2">{{ $producto->nombre }}</td>
                    <td class="border border-gray-300 dark:border-neutral-600 px-4 py-2">${{ number_format($producto->precio_unitario, 2) }}</td>
                    <td class="border border-gray-300 dark:border-neutral-600 px-4 py-2 space-x-2">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">No hay productos aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
