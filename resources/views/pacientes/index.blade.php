<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Lista de Pacientes</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('pacientes.create') }}"
            class="mb-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
            + Nuevo Paciente
        </a>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
            <form method="GET" action="{{ route('pacientes.index') }}" class="mb-4">
                <div class="flex">
                    <input type="text" inputmode="numeric" name="cedula" placeholder="Buscar por cédula"
                        minlength="10" maxlength="10" value="{{ request('cedula') }}"
                        class="border-gray-300 rounded-l px-4 py-2 w-64"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">
                        Buscar
                    </button>
                </div>
            </form>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Cédula
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nombres
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Apellidos
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Estado Civil
                        </th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($pacientes as $paciente)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $paciente->pac_cedula }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $paciente->pac_nombres }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $paciente->pac_apellidos }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $paciente->estadoCivil->estc_nombre ?? 'Sin estado' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center space-x-3">
                                <a href="{{ route('pacientes.show', $paciente->pac_cedula) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                                <span class="text-gray-300">|</span>
                                <a href="{{ route('pacientes.edit', $paciente->pac_cedula) }}"
                                    class="text-yellow-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">No hay
                                pacientes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pacientes->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
