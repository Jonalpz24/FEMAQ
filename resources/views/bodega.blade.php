<x-layouts.app :title="__('Bodegas')">
    <div class="flex h-full w-full flex-1 flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Bienvenido a la Bodega
        </h1>
        <p class="mt-4 text-gray-600 dark:text-gray-400">
            Aquí puedes visualizar los detalles de las bodegas.
        </p>
        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($bodegas as $bodega)
                <div class="rounded-lg border border-gray-200 p-4 shadow-md dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        {{ $bodega->nombre }}
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $bodega->ubicación }}
                    </p>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Responsable: {{ $bodega->responsable->name }}
                    </p>
                    <!-- Botón para descargar reporte -->
                    <a 
                        href="{{ route('bodegas.reporte', $bodega->id) }}" 
                        class="mb-2 inline-block rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                        Reporte
                    </a>
                    <!-- Botón para mostrar productos -->
                    <button 
                        class="mt-2 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600"
                        onclick="document.getElementById('productosModal-{{ $bodega->id }}').classList.remove('hidden')">
                        Ver Productos
                    </button>
                    <!-- Modal para productos -->
                    <div id="productosModal-{{ $bodega->id }}" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
                            <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Productos en {{ $bodega->nombre }}</h2>
                            <ul class="mb-4 text-gray-600 dark:text-gray-400">
                                @if (!empty($bodega->inventario) && is_iterable($bodega->inventario))
                                    @foreach ($bodega->inventario as $item)
                                        <li>- {{ $item->producto->nombre }} (Cantidad: {{ $item->cantidad }})</li>
                                    @endforeach
                                @else
                                    <li>No hay productos disponibles.</li>
                                @endif
                            </ul>
                            <div class="flex justify-end">
                                <button 
                                    class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                                    onclick="document.getElementById('productosModal-{{ $bodega->id }}').classList.add('hidden')">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Botón para agregar nueva bodega -->
        <button 
            class="mt-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
            onclick="document.getElementById('addBodegaModal').classList.remove('hidden')">
            Agregar Nueva Bodega
        </button>
        <!-- Modal para formulario -->
        <div id="addBodegaModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Nueva Bodega</h2>
                <form action="{{ route('bodegas.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required class="mt-1 w-full rounded border-gray-300 p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    </div>
                    <div class="mb-4">
                        <label for="ubicación" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                        <input type="text" id="ubicación" name="ubicación" required class="mt-1 w-full rounded border-gray-300 p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    </div>
                    <div class="mb-4">
                        <label for="responsable" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Responsable</label>
                        <select id="responsable" name="responsable_id" required class="mt-1 w-full rounded border-gray-300 p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" 
                            class="mr-2 rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                            onclick="document.getElementById('addBodegaModal').classList.add('hidden')">
                            Cancelar
                        </button>
                        <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Fin del modal -->
        
    </div>
</x-layouts.app>
