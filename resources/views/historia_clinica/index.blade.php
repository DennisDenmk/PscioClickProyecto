<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Historias Clínicas
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
            <!-- Botón "Nueva Historia" -->
            <a href="{{ route('historia_clinica.create') }}"
               class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                + Nueva Historia Clínica
            </a>

            <!-- Formulario de búsqueda -->
            <form method="GET" class="flex">
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
            @if ($historias->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay historias clínicas registradas.
                </div>
            @else
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de creación</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($historias as $historia)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $historia->paciente->pac_cedula }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $historia->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vista de tarjetas para pantallas pequeñas y medianas -->
                <div class="block lg:hidden">
                    <div class="p-4 space-y-4">
                        @foreach ($historias as $historia)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Paciente</div>
                                        <div class="text-sm text-gray-900">{{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Cédula</div>
                                        <div class="text-sm text-gray-900">{{ $historia->paciente->pac_cedula }}</div>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="text-sm font-medium text-gray-500">Fecha de creación</div>
                                        <div class="text-sm text-gray-900">{{ $historia->created_at->format('d/m/Y') }}</div>
                                    </div>
                                    <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                        <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                            Ver Historia
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">{{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}</div>
                                        <div class="text-sm text-gray-600">Cédula: {{ $historia->paciente->pac_cedula }}</div>
                                    </div>
                                </div>

                                <div class="space-y-1 text-sm text-gray-600 mb-3">
                                    <div><span class="font-medium">Fecha:</span> {{ $historia->created_at->format('d/m/Y') }}</div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
                                        class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200 flex-1">
                                        Ver Historia
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Paginación -->
                @if($historias->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200">
                        {{ $historias->appends(request()->query())->links('custom-pagination') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
