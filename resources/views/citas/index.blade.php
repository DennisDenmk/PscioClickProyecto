<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Lista de Citas
        </h2>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Botón de nueva cita -->
            <div class="flex justify-end">
                <a href="{{ route('citas.create') }}"
                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                    + Nueva Cita
                </a>
            </div>

            <!-- Contenedor de la tabla -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase">Paciente</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase">Doctor</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase">Hora</th>
                            <th class="px-6 py-3 text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-600">
                        @foreach ($citas as $cita)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cita->paciente->pac_nombres }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cita->doctor->doc_nombres }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cita->cit_fecha }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $cita->cit_hora_inicio }} - {{ $cita->cit_hora_fin }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('citas.edit', $cita->cit_id) }}"
                                        class="text-indigo-600 hover:text-indigo-400 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold transition">
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
