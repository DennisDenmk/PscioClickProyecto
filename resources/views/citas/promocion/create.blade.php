<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Crear Promoción
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 px-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
            <form method="POST" action="{{ route('promociones.store') }}" class="space-y-6">
                @csrf

                <x-input-label for="prom_nombre" value="Nombre" />
                <x-text-input
                    id="prom_nombre"
                    name="prom_nombre"
                    class="w-full"
                    required
                />

                <x-input-label for="prom_descripcion" value="Descripción" />
                <textarea
                    id="prom_descripcion"
                    name="prom_descripcion"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 text-gray-900 dark:text-gray-100"
                    rows="4"
                ></textarea>

                <x-input-label for="prom_precio" value="Precio ($)" />
                <x-text-input
                    id="prom_precio"
                    name="prom_precio"
                    type="number"
                    step="0.01"
                    class="w-full"
                    required
                />

                <x-input-label for="prom_sesiones" value="Número de Sesiones" />
                <x-text-input
                    id="prom_sesiones"
                    name="prom_sesiones"
                    type="number"
                    class="w-full"
                    required
                />

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow transition duration-300"
                >
                    Guardar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
