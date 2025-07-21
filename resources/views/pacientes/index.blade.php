<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Pacientes
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón y buscador -->
        <div class="mb-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Botón "Nuevo Paciente" -->
            <a href="{{ route('pacientes.create') }}"
               class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                + Nuevo Paciente
            </a>

            <!-- Formulario de búsqueda -->
            <form method="GET" action="{{ route('pacientes.index') }}" class="flex">
                <input type="text" inputmode="numeric" name="cedula" placeholder="Buscar por cédula"
                    minlength="10" maxlength="10" value="{{ request('cedula') }}"
                    class="border border-gray-300 rounded-l-lg px-4 py-2 w-full lg:w-64 focus:ring-2 focus:ring-[#0b5d63] focus:border-[#0b5d63]"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                <button type="submit"
                    class="bg-primarycolor-logo text-white px-4 py-2 rounded-r-lg hover:bg-[#09494e] transition duration-200">
                    Buscar
                </button>
            </form>
        </div>


        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Vista de tabla para pantallas grandes -->
            <div class="hidden lg:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado Civil</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pacientes as $paciente)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $paciente->pac_cedula }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $paciente->pac_nombres }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $paciente->pac_apellidos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $paciente->estadoCivil->estc_nombre ?? 'Sin estado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <a href="{{ route('pacientes.show', $paciente->pac_cedula) }}"
                                            class="text-blue-600 hover:text-blue-900 font-medium mr-3">
                                            Ver
                                        </a>
                                        <a href="{{ route('pacientes.edit', $paciente->pac_cedula) }}"
                                            class="text-yellow-600 hover:text-yellow-900 font-medium">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">
                                        No hay pacientes registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Vista de tarjetas para pantallas pequeñas y medianas -->
            <div class="block lg:hidden">
                <div class="p-4 space-y-4">
                    @forelse($pacientes as $paciente)
                        <!-- Vista de tarjeta para tablets -->
                        <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Cédula</div>
                                    <div class="text-sm text-gray-900">{{ $paciente->pac_cedula }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Estado Civil</div>
                                    <div class="text-sm text-gray-900">{{ $paciente->estadoCivil->estc_nombre ?? 'Sin estado' }}</div>
                                </div>
                                <div class="col-span-2">
                                    <div class="text-sm font-medium text-gray-500">Nombre Completo</div>
                                    <div class="text-sm text-gray-900">{{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }}</div>
                                </div>
                                <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                    <a href="{{ route('pacientes.show', $paciente->pac_cedula) }}"
                                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                        Ver Paciente
                                    </a>
                                    <a href="{{ route('pacientes.edit', $paciente->pac_cedula) }}"
                                        class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700 transition duration-200">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Vista compacta para móviles -->
                        <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }}</div>
                                    <div class="text-sm text-gray-600">Cédula: {{ $paciente->pac_cedula }}</div>
                                </div>
                            </div>

                            <div class="space-y-1 text-sm text-gray-600 mb-3">
                                <div><span class="font-medium">Estado Civil:</span> {{ $paciente->estadoCivil->estc_nombre ?? 'Sin estado' }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('pacientes.show', $paciente->pac_cedula) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200 flex-1">
                                    Ver Paciente
                                </a>
                                <a href="{{ route('pacientes.edit', $paciente->pac_cedula) }}"
                                    class="bg-yellow-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-yellow-700 transition duration-200 flex-1">
                                    Editar
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No hay pacientes registrados.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Paginación -->
            @if($pacientes->hasPages())
                <div class="px-4 py-3 border-t border-gray-200">
                    {{ $pacientes->withQueryString()->links('custom-pagination') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
