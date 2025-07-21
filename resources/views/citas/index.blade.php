<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Lista de Citas
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('tipocita.index') }}"
                   class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                    Gestión tipo de citas
                </a>
                <a href="{{ route('citas.create') }}"
                   class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                    + Nueva Cita
                </a>
            </div>


            <!-- Filtros -->
            <div class="bg-white shadow rounded-lg p-4">
                <form method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="flex-1">
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Todos --</option>
                            @foreach ($estados as $e)
                                <option value="{{ $e->estc_id }}"
                                    {{ request('estado') == $e->estc_id ? 'selected' : '' }}>
                                    {{ $e->estc_nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($citas as $cita)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->paciente->pac_nombres }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->paciente->pac_cedula }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->doctor->doc_nombres }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->cit_hora_inicio }} - {{ $cita->cit_hora_fin }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->cit_fecha }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $cita->estadoCita->estc_nombre }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                            <a href="{{ route('citas.edit', $cita->cit_id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                Editar
                                            </a>
                                            <a href="{{ route('citas.show', $cita->cit_id) }}"
                                                class="text-red-600 hover:text-red-900 font-medium">
                                                Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vista de tarjetas para pantallas medianas -->
                <div class="hidden md:block lg:hidden">
                    <div class="p-4 space-y-4">
                        @foreach ($citas as $cita)
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Paciente</div>
                                        <div class="text-sm text-gray-900">{{ $cita->paciente->pac_nombres }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Cédula</div>
                                        <div class="text-sm text-gray-900">{{ $cita->paciente->pac_cedula }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Doctor</div>
                                        <div class="text-sm text-gray-900">{{ $cita->doctor->doc_nombres }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Fecha</div>
                                        <div class="text-sm text-gray-900">{{ $cita->cit_fecha }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Hora</div>
                                        <div class="text-sm text-gray-900">{{ $cita->cit_hora_inicio }} - {{ $cita->cit_hora_fin }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Estado</div>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $cita->estadoCita->estc_nombre }}
                                        </span>
                                    </div>
                                    <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                        <a href="{{ route('citas.edit', $cita->cit_id) }}"
                                            class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition duration-200">
                                            Editar
                                        </a>
                                        <a href="{{ route('citas.show', $cita->cit_id) }}"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition duration-200">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Vista compacta para móviles -->
                <div class="block md:hidden">
                    <div class="p-4 space-y-3">
                        @foreach ($citas as $cita)
                            <div class="bg-gray-50 rounded-lg p-3 border">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $cita->paciente->pac_nombres }}</div>
                                        <div class="text-sm text-gray-600">{{ $cita->paciente->pac_cedula }}</div>
                                    </div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $cita->estadoCita->estc_nombre }}
                                    </span>
                                </div>

                                <div class="space-y-1 text-sm text-gray-600 mb-3">
                                    <div><span class="font-medium">Doctor:</span> {{ $cita->doctor->doc_nombres }}</div>
                                    <div><span class="font-medium">Fecha:</span> {{ $cita->cit_fecha }}</div>
                                    <div><span class="font-medium">Hora:</span> {{ $cita->cit_hora_inicio }} - {{ $cita->cit_hora_fin }}</div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('citas.edit', $cita->cit_id) }}"
                                        class="bg-indigo-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-indigo-700 transition duration-200">
                                        Editar Cita
                                    </a>
                                    <a href="{{ route('citas.show', $cita->cit_id) }}"
                                        class="bg-red-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-red-700 transition duration-200">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $citas->appends(request()->query())->links('custom-pagination') }}
            </div>
        </div>
    </div>
</x-app-layout>
