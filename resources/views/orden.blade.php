<x-layouts.app :title="__('Generar Orden')">
    <div class="flex h-full w-full flex-1 flex-col items-center justify-center gap-4">
        <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-300">
            Generar Orden
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
            Aquí puedes generar una nueva orden.
        </p>
        @if (session('success'))
            <div class="mb-4 w-full max-w-md rounded-md bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ url('/orden') }}" method="POST" class="w-full max-w-md">
            @csrf

            <div class="mb-4">
                <label for="bodega" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bodega</label>
                <select id="bodega" name="bodega" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-300" required onchange="filtrarProductos()">
                    <option value="" disabled selected>Selecciona una bodega</option>
                    @foreach ($bodegas as $bodega)
                        <option value="{{ $bodega->id }}">{{ $bodega->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="proveedor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Proveedor</label>
                <input type="text" id="proveedor" name="proveedor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-300" placeholder="Nombre del proveedor" required>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-300" required>
            </div>

            <div id="productos-container">
                @if ($inventarios->isEmpty())
                    <p class="text-sm text-red-500 dark:text-red-400">No hay productos disponibles en el inventario para esta bodega.</p>
                @else
                    <div class="producto-item mb-4 flex gap-2">
                        <select name="productos[]" class="w-2/3 rounded-md dark:bg-neutral-800 dark:text-white" disabled required>
                            <option value="" disabled selected>Selecciona un producto</option>
                            @foreach ($inventarios as $inventario)
                                <option value="{{ $inventario->producto_id }}" data-bodega="{{ $inventario->bodega_id }}">{{ $inventario->producto->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="cantidades[]" class="w-1/3 rounded-md dark:bg-neutral-800 dark:text-white" placeholder="Cantidad" disabled required>
                    </div>
                @endif
            </div>

            <button type="button" onclick="agregarProducto()" class="mb-4 rounded bg-gray-200 px-4 py-2 dark:bg-gray-700 dark:text-white">+ Añadir producto</button>

            <button type="submit" class="w-full rounded-md bg-indigo-600 py-2 px-4 text-white hover:bg-indigo-700">
                Generar Orden
            </button>
        </form>
    </div>

    <div id="email-modal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 dark:bg-neutral-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Enviar Reporte por Correo</h3>
            <form id="email-form" action="" method="POST">
                @csrf
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-300" placeholder="ejemplo@correo.com" required>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="cerrarModal()" class="rounded bg-gray-200 px-4 py-2 dark:bg-gray-700 dark:text-white">Cancelar</button>
                    <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 w-full max-w-4xl">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-300">Reportes de Envío</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($reportes_envio as $reporte)
                <div class="rounded-lg border border-gray-300 bg-white p-4 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Proveedor: {{ $reporte->proveedor }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Fecha: {{ $reporte->fecha }}</p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Total: {{ $reporte->total }}</p>
                    <button onclick="window.location.href='{{ url('/reporte-envio/pdf/' . $reporte->id) }}'" 
                            class="mt-4 w-full rounded-md bg-blue-600 py-2 px-4 text-white hover:bg-blue-700">
                        Enviar
                    </button>
                    <button onclick="abrirModal('{{ url('/reporte-envio/email/' . $reporte->id) }}')" 
                            class="mt-4 w-full rounded-md bg-green-600 py-2 px-4 text-white hover:bg-green-700">
                        Enviar por Correo
                    </button>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 dark:text-gray-400">No hay reportes de envío disponibles.</p>
            @endforelse
        </div>
    </div>

    <script>
        function filtrarProductos() {
            const bodegaId = document.getElementById('bodega').value;
            const productos = document.querySelectorAll('#productos-container select[name="productos[]"]');
            const cantidades = document.querySelectorAll('#productos-container input[name="cantidades[]"]');

            productos.forEach((select) => {
                select.disabled = !bodegaId;
                if (bodegaId) {
                    Array.from(select.options).forEach((option) => {
                        option.style.display = option.dataset.bodega === bodegaId ? 'block' : 'none';
                    });
                    select.value = ""; // Reset the selected value
                }
            });

            cantidades.forEach((input) => {
                input.disabled = !bodegaId;
            });
        }

        function agregarProducto() {
            const container = document.getElementById('productos-container');
            const div = document.createElement('div');
            div.classList.add('producto-item', 'mb-4', 'flex', 'gap-2');
            div.innerHTML = `
                <select name="productos[]" class="w-2/3 rounded-md dark:bg-neutral-800 dark:text-white" disabled required>
                    <option value="" disabled selected>Selecciona un producto</option>
                    @foreach ($inventarios as $inventario)
                        <option value="{{ $inventario->producto_id }}" data-bodega="{{ $inventario->bodega_id }}">{{ $inventario->producto->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="cantidades[]" class="w-1/3 rounded-md dark:bg-neutral-800 dark:text-white" placeholder="Cantidad" disabled required>
            `;
            container.appendChild(div);
            filtrarProductos(); // Aplicar filtro a los nuevos elementos
        }

        function abrirModal(actionUrl) {
            const modal = document.getElementById('email-modal');
            const form = document.getElementById('email-form');
            form.action = actionUrl;
            modal.classList.remove('hidden');
        }

        function cerrarModal() {
            const modal = document.getElementById('email-modal');
            modal.classList.add('hidden');
        }
    </script>
</x-layouts.app>
