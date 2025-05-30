<x-layouts.app title="Clientes">
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Clientes</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario para crear nuevo cliente --}}
        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4 mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input name="nombre" placeholder="Nombre" class="rounded-md dark:bg-neutral-700 dark:text-white" required>
                <input name="apellido" placeholder="Apellido" class="rounded-md dark:bg-neutral-700 dark:text-white" required>
                <input name="email" type="email" placeholder="Email" class="rounded-md dark:bg-neutral-700 dark:text-white">
                <input name="telefono" placeholder="Teléfono" class="rounded-md dark:bg-neutral-700 dark:text-white">
                <input name="direccion" placeholder="Dirección" class="rounded-md dark:bg-neutral-700 dark:text-white">
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Guardar</button>
        </form>

        {{-- Tabla de clientes --}}
        <table class="w-full table-auto border-collapse border border-gray-300 dark:border-neutral-600">
            <thead>
                <tr class="bg-gray-100 dark:bg-neutral-700">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nombre</th>
                    <th class="border px-4 py-2">Apellido</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Teléfono</th>
                    <th class="border px-4 py-2">Dirección</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                        <td class="border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="border px-4 py-2">{{ $cliente->apellido }}</td>
                        <td class="border px-4 py-2">{{ $cliente->email }}</td>
                        <td class="border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="border px-4 py-2">{{ $cliente->direccion }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('¿Eliminar cliente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
