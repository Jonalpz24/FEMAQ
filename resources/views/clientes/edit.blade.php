<x-layouts.app :title="'Editar Cliente: ' . $cliente->nombre">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Editar Cliente</h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 text-red-800 bg-red-100 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required
                       class="w-full rounded-md dark:bg-neutral-700 dark:text-white px-3 py-2">
            </div>

            {{-- Apellido --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $cliente->apellido) }}" required
                       class="w-full rounded-md dark:bg-neutral-700 dark:text-white px-3 py-2">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email', $cliente->email) }}"
                       class="w-full rounded-md dark:bg-neutral-700 dark:text-white px-3 py-2">
            </div>

            {{-- Teléfono --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                       class="w-full rounded-md dark:bg-neutral-700 dark:text-white px-3 py-2">
            </div>

            {{-- Dirección --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                <textarea name="direccion" rows="3"
                          class="w-full rounded-md dark:bg-neutral-700 dark:text-white px-3 py-2">{{ old('direccion', $cliente->direccion) }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
