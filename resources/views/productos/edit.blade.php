<x-layouts.app :title="'Editar Producto: ' . $producto->nombre">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Editar Producto</h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Campo: Nombre --}}
        <form action="{{ route('productos.updateField', ['producto' => $producto->id, 'field' => 'nombre']) }}" method="POST" class="mb-4">
            @csrf @method('PATCH')
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
            <div class="flex gap-2 mt-1">
                <input name="value" value="{{ $producto->nombre }}" required class="flex-1 rounded-md dark:bg-neutral-700 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Actualizar</button>
            </div>
        </form>

        {{-- Campo: Descripción --}}
        <form action="{{ route('productos.updateField', ['producto' => $producto->id, 'field' => 'descripción']) }}" method="POST" class="mb-4">
            @csrf @method('PATCH')
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
            <div class="flex gap-2 mt-1">
                <textarea name="value" rows="3" class="flex-1 rounded-md dark:bg-neutral-700 dark:text-white">{{ $producto->descripción }}</textarea>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md self-start">Actualizar</button>
            </div>
        </form>

        {{-- Campo: Unidad de medida --}}
        <form action="{{ route('productos.updateField', ['producto' => $producto->id, 'field' => 'unidad_medida']) }}" method="POST" class="mb-4">
            @csrf @method('PATCH')
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unidad de Medida</label>
            <div class="flex gap-2 mt-1">
                <select name="value" class="flex-1 rounded-md dark:bg-neutral-700 dark:text-white">
                    <option {{ $producto->unidad_medida == 'PIEZA' ? 'selected' : '' }}>PIEZA</option>
                    <option {{ $producto->unidad_medida == 'PAQUETE' ? 'selected' : '' }}>PAQUETE</option>
                    <option {{ $producto->unidad_medida == 'KILO' ? 'selected' : '' }}>KILO</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Actualizar</button>
            </div>
        </form>

        {{-- Campo: Precio Unitario --}}
        <form action="{{ route('productos.updateField', ['producto' => $producto->id, 'field' => 'precio_unitario']) }}" method="POST" class="mb-4">
            @csrf @method('PATCH')
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio Unitario</label>
            <div class="flex gap-2 mt-1">
                <input name="value" type="number" step="0.01" value="{{ $producto->precio_unitario }}" required class="flex-1 rounded-md dark:bg-neutral-700 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Actualizar</button>
            </div>
        </form>

        {{-- Campo: URL Imagen --}}
        <form action="{{ route('productos.updateField', ['producto' => $producto->id, 'field' => 'imagen_url']) }}" method="POST" class="mb-4">
            @csrf @method('PATCH')
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL de Imagen</label>
            <div class="flex gap-2 mt-1">
                <input name="value" type="url" value="{{ $producto->imagen_url }}" class="flex-1 rounded-md dark:bg-neutral-700 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Actualizar</button>
            </div>
        </form>

        <div class="flex justify-center mt-6">
    <a href="{{ url('/crear') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
        Regresar
    </a>
</div>
    </div>
</x-layouts.app>
