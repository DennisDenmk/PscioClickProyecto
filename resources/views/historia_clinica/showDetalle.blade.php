<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Detalles de Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Información del Paciente -->
        <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
            <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm text-gray-600">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <!-- Botón Crear Nueva Consulta -->
        <div class="mb-6">
            <a href="{{ route('detalles.create', $historia->his_id) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Crear Nueva Consulta
            </a>
        </div>

        <!-- Contenido de Detalles -->
        @if ($detalles->isEmpty())
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 text-center text-gray-500">
                    No hay detalles registrados.
                </div>
            </div>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Detalles de Consulta</h3>
                </div>

                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peso</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Talla</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IMC</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Valoración</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($detalles as $detalle)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="max-w-xs truncate">{{ $detalle->deth_motivo_consulta }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalle->deth_peso }} kg</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalle->deth_talla }} cm</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalle->deth_imc }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalle->deth_fecha_valoracion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium">
                                                Editar
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
                        @foreach ($detalles as $detalle)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <div class="text-sm font-medium text-gray-500">Motivo de Consulta</div>
                                        <div class="text-sm text-gray-900">{{ $detalle->deth_motivo_consulta }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Peso</div>
                                        <div class="text-sm text-gray-900">{{ $detalle->deth_peso }} kg</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Talla</div>
                                        <div class="text-sm text-gray-900">{{ $detalle->deth_talla }} cm</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">IMC</div>
                                        <div class="text-sm text-gray-900">{{ $detalle->deth_imc }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Fecha Valoración</div>
                                        <div class="text-sm text-gray-900">{{ $detalle->deth_fecha_valoracion }}</div>
                                    </div>
                                    <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                        <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                            Editar Detalle
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="mb-3">
                                    <div class="font-medium text-gray-900 mb-1">{{ $detalle->deth_motivo_consulta }}</div>
                                    <div class="text-sm text-gray-600">{{ $detalle->deth_fecha_valoracion }}</div>
                                </div>

                                <div class="grid grid-cols-3 gap-2 text-sm text-gray-600 mb-3">
                                    <div>
                                        <span class="font-medium">Peso:</span><br>
                                        {{ $detalle->deth_peso }} kg
                                    </div>
                                    <div>
                                        <span class="font-medium">Talla:</span><br>
                                        {{ $detalle->deth_talla }} cm
                                    </div>
                                    <div>
                                        <span class="font-medium">IMC:</span><br>
                                        {{ $detalle->deth_imc }}
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                        class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200 flex-1">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Paginación -->
                @if($detalles->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200">
                        {{ $detalles->links('custom-pagination') }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
