<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Lista de Historias Clínicas
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <form method="GET" class="mb-4 flex flex-wrap gap-4">
            <div>
                <label for="cedula" class="block text-sm font-medium">Buscar por Cédula</label>
                <input type="text" name="cedula" id="cedula" value="{{ request('cedula') }}"
                    class="mt-1 block w-full border-gray-300 rounded px-2 py-1">
            </div>

            <div class="self-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Buscar
                </button>
            </div>
        </form>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6">
            @if ($historias->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No hay historias clínicas registradas.</p>
            @else
                <!-- Tabla responsive -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Paciente</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Cédula</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Fecha de creación </th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @foreach ($historias as $historia)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $historia->paciente->pac_cedula }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $historia->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold transition">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $historias->appends(request()->query())->links('custom-pagination') }}
                    </div>

                </div>
            @endif
        </div>
    </div>
</x-app-layout>
