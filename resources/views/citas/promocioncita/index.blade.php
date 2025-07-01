<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Lista de Promociones de Citas
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('promocioncita.create') }}"
               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition duration-300">
                + Nuevo
            </a>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">ID</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Cita</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Promoción</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Sesiones Usadas</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-sm font-semibold text-gray-700 dark:text-gray-200">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($promocionesCitas as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $item->proc_cit_id }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $item->cita->cit_id ?? 'N/A' }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $item->promocion->prom_nombre ?? 'N/A' }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $item->proc_sesiones_usadas }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-sm">
                                <a href="{{ route('promocioncita.edit', $item->proc_cit_id) }}" class="text-blue-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($promocionesCitas->isEmpty())
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">No hay promociones de citas registradas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
