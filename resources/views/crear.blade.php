<x-layouts.app :title="__('Añadir Producto')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
            Añadir Producto
        </h1>
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
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="descripción" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Descripción
                </label>
                <textarea id="descripción" name="descripción" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300"></textarea>
            </div>
            <div class="mb-4">
                <label for="unidad_medida" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Unidad de Medida
                </label>
                <select id="unidad_medida" name="unidad_medida" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300" required>
                    <option value="PIEZA">PIEZA</option>
                    <option value="PAQUETE">PAQUETE</option>
                    <option value="KILO">KILO</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="precio_unitario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Precio Unitario
                </label>
                <input type="number" id="precio_unitario" name="precio_unitario" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-gray-300" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
