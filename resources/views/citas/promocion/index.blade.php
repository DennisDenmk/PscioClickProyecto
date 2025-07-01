<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Lista de Promociones
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-4">
        <!-- Botón Nueva Promoción -->
        <div class="flex justify-start">
            <a href="{{ route('promociones.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded shadow transition duration-300">
               + Nueva Promoción
            </a>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-2xl">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Sesiones</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-600">
                    @foreach($promociones as $promocion)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $promocion->prom_nombre }}</td>
                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $promocion->prom_descripcion }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">$ {{ number_format($promocion->prom_precio, 2) }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $promocion->prom_sesiones }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('promociones.edit', $promocion->prom_id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold">
                               Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
