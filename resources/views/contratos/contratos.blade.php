<x-layouts.app :title="'Crear Contrato'">
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6">Crear Contrato</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contratos.store') }}" method="POST">
            @csrf

            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Cliente</label>
            <select name="cliente_id" required class="w-full mb-4 rounded-md dark:bg-neutral-700 dark:text-white">
                <option value="" disabled selected>Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Producto</label>
            <select name="producto_id" required class="w-full mb-4 rounded-md dark:bg-neutral-700 dark:text-white">
                <option value="" disabled selected>Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Cantidad</label>
            <input type="number" name="cantidad" value="{{ old('cantidad', 1) }}" min="1" required
                   class="w-full mb-4 rounded-md dark:bg-neutral-700 dark:text-white">

            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Fecha de Contrato</label>
            <input type="date" name="fecha_contrato" value="{{ old('fecha_contrato') }}"
                   class="w-full mb-4 rounded-md dark:bg-neutral-700 dark:text-white">

            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Crear Contrato
            </button>
        </form>
    </div>

    {{-- Tabla de contratos --}}
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-neutral-800 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Contratos Registrados</h2>

    <table class="w-full border border-gray-300 dark:border-neutral-700 rounded-md overflow-hidden text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="bg-gray-100 dark:bg-neutral-700">
            <tr>
                <th class="px-4 py-2 border-b">Cliente</th>
                <th class="px-4 py-2 border-b">Producto</th>
                <th class="px-4 py-2 border-b">Cantidad</th>
                <th class="px-4 py-2 border-b">Fecha</th>
                <th class="px-4 py-2 border-b">Total Costo</th>
                <th class="px-4 py-2 border-b">Acciones</th> {{-- Nueva columna para botones --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($contratos as $contrato)
                <tr class="border-b border-gray-200 dark:border-neutral-700">
                    <td class="px-4 py-2">{{ $contrato->cliente->nombre }} {{ $contrato->cliente->apellido }}</td>
                    <td class="px-4 py-2">{{ $contrato->producto->nombre }}</td>
                    <td class="px-4 py-2">{{ $contrato->cantidad }}</td>
                    <td class="px-4 py-2">{{ $contrato->fecha_contrato ? \Carbon\Carbon::parse($contrato->fecha_contrato)->format('d/m/Y') : '-' }}</td>
                    <td class="px-4 py-2">${{ number_format($contrato->total_costo, 2) }}</td>
                    <td class="px-4 py-2">
                         {{-- Botón PDF --}}
                            <a href="{{ route('contratos.pdf', $contrato) }}" target="_blank" class="text-blue-600 hover:underline">PDF</a>
                        
                        
                        <form action="{{ route('contratos.destroy', $contrato) }}" method="POST" onsubmit="return confirm('¿Eliminar contrato?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-2 text-center text-gray-500">No hay contratos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-layouts.app>
