<x-layouts.app :title="__('Home')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-neutral-800">
                    <a href="{{ url('/crear') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Añadir Productos
                    </a>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-neutral-800">
                    <a href="{{ url('/bodegas') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Ver Bodega
                    </a>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-neutral-800">
                    <a href="{{ url('/inventario') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Modificar Inventario
                    </a>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-neutral-800">
                    <a href="{{ url('/orden') }}" class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Generar Orden
                    </a>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
