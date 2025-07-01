<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Tipos de Citas
        </h2>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-6">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded-lg shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Botón arriba a la derecha del contenedor -->
            <div class="flex justify-end">
                <a href="{{ route('tipocita.create') }}"
                    class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow transition mb-4">
                    + Añadir tipo
                </a>
            </div>

            <!-- Tabla -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Nombre</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Duración (min)</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-600">
                        @foreach($tipos as $tipo)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $tipo->tipc_nombre }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $tipo->tipc_duracion_minutos }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('tipocita.edit', $tipo->tipc_id) }}"
                                        class="text-indigo-600 hover:underline dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
