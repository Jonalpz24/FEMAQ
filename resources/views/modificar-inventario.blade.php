<x-layouts.app :title="__('Modificar Inventario')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if (session('success'))
            <div class="rounded-md bg-green-100 p-4">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <form action="{{ url('/inventario') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="producto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Seleccionar Producto
                </label>
                <select id="producto" name="producto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:text-gray-300">
                    <!-- Opciones de productos -->
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="bodega" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Seleccionar Bodega
                </label>
                <select id="bodega" name="bodega" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:text-gray-300">
                    <!-- Opciones de bodegas -->
                    @foreach ($bodegas as $bodega)
                        <option value="{{ $bodega->id }}">{{ $bodega->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Cantidad
                </label>
                <input type="number" id="cantidad" name="cantidad" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:text-gray-300">
            </div>
            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 py-2 px-4 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Modificar Inventario
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
