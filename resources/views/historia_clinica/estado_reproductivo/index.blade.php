<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Estado Reproductivo - Historia Clínica #{{ $his_id ?? ($estados->first()->est_his_id ?? '') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        @php
            $pacienteInfo = null;
            if($his_id || $estados->isNotEmpty()) {
                $historia_id = $his_id ?? $estados->first()->est_his_id;
                $historia = \App\Models\HistoriaClinica::with('paciente')->find($historia_id);
                $pacienteInfo = $historia ? $historia->paciente : null;
            }
        @endphp

        @if ($pacienteInfo)
            <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
                <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                    Paciente: {{ $pacienteInfo->pac_nombres }} {{ $pacienteInfo->pac_apellidos }}
                </h3>
                <p class="text-sm text-gray-600">Cédula: {{ $pacienteInfo->pac_cedula }}</p>
            </div>
        @endif

        <!-- Botón Registrar Estado -->
        <div class="mb-6">
            <a href="{{ route('estado_reproductivo.create', $his_id ?? ($estados->first()->est_his_id ?? '') ) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Registrar Estado Reproductivo
            </a>
        </div>

        <!-- Estados Reproductivos Registrados -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Estados Reproductivos Registrados</h4>
            </div>

            @if($estados->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay estados reproductivos registrados para esta historia clínica.
                    <div class="mt-2">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h10l2 2h9a2 2 0 012 2v1M9 12v7a2 2 0 002 2h10m-12-4h6m-6 4h6"/>
                        </svg>
                    </div>
                </div>
            @else
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Historia Clínica</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado de Embarazo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad de Hijos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($estados as $estado)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="h-3 w-3 bg-blue-500 rounded-full"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Historia #{{ $estado->est_his_id }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $estado->est_esta_embarazada ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $estado->est_esta_embarazada ? 'Embarazada' : 'No embarazada' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                {{ $estado->est_cantidad_hijos }} {{ $estado->est_cantidad_hijos == 1 ? 'hijo' : 'hijos' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $estado->created_at ? $estado->created_at->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 font-medium"
                                                        onclick="mostrarDetalle('{{ $estado->est_his_id }}', '{{ $estado->est_esta_embarazada ? 'Sí' : 'No' }}', '{{ $estado->est_cantidad_hijos }}', '{{ $estado->created_at ? $estado->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                    Ver Detalle
                                                </button>
                                                <a href="{{ route('estado_reproductivo.edit', $estado->est_id) }}"
                                                   class="text-green-600 hover:text-green-900 font-medium ml-3">
                                                    Editar
                                                </a>
                                            </div>
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
                        @foreach ($estados as $estado)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-3 w-3 bg-blue-500 rounded-full mr-3"></div>
                                        <div class="font-medium text-gray-900">Estado Reproductivo</div>
                                    </div>

                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Historia Clínica</div>
                                        <div class="text-sm text-gray-900">#{{ $estado->est_his_id }}</div>
                                    </div>

                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Estado de Embarazo</div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $estado->est_esta_embarazada ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $estado->est_esta_embarazada ? 'Embarazada' : 'No embarazada' }}
                                        </span>
                                    </div>

                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Cantidad de Hijos</div>
                                        <div class="text-sm text-gray-900 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            {{ $estado->est_cantidad_hijos }} {{ $estado->est_cantidad_hijos == 1 ? 'hijo' : 'hijos' }}
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            {{ $estado->created_at ? $estado->created_at->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200"
                                                    onclick="mostrarDetalle('{{ $estado->est_his_id }}', '{{ $estado->est_esta_embarazada ? 'Sí' : 'No' }}', '{{ $estado->est_cantidad_hijos }}', '{{ $estado->created_at ? $estado->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                Ver Detalle
                                            </button>
                                            <a href="{{ route('estado_reproductivo.edit', $estado->est_id) }}"
                                               class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition duration-200">
                                                Editar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center flex-1">
                                        <div class="flex-shrink-0 h-3 w-3 bg-blue-500 rounded-full mr-2"></div>
                                        <div class="font-medium text-gray-900 text-sm">
                                            Historia #{{ $estado->est_his_id }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $estado->est_esta_embarazada ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $estado->est_esta_embarazada ? 'Embarazada' : 'No embarazada' }}
                                    </span>
                                    <span class="ml-2 text-xs text-gray-600">
                                        {{ $estado->est_cantidad_hijos }} {{ $estado->est_cantidad_hijos == 1 ? 'hijo' : 'hijos' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-600">
                                        {{ $estado->created_at ? $estado->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <div class="flex space-x-1">
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition duration-200"
                                                onclick="mostrarDetalle('{{ $estado->est_his_id }}', '{{ $estado->est_esta_embarazada ? 'Sí' : 'No' }}', '{{ $estado->est_cantidad_hijos }}', '{{ $estado->created_at ? $estado->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                            Ver
                                        </button>
                                        <a href="{{ route('estado_reproductivo.edit', $estado->est_id) }}"
                                           class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700 transition duration-200">
                                            Editar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Navegación -->
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('historia_clinica.home', $his_id ?? ($estados->first()->est_his_id ?? '')) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Historia Clínica
            </a>
            <a href="{{ route('historia_clinica.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lista de Historias
            </a>
        </div>
    </div>

    <!-- Modal para mostrar detalle completo -->
    <div id="modalDetalle" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-3 w-3 bg-blue-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-medium text-gray-900">Detalle del Estado Reproductivo</h3>
                    </div>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <div class="font-medium text-gray-700 mb-1">Historia Clínica:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalHistoria">
                            <!-- Contenido de la historia -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Estado de Embarazo:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalEmbarazo">
                            <!-- Contenido del estado de embarazo -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Cantidad de Hijos:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalHijos">
                            <!-- Contenido de la cantidad de hijos -->
                        </div>
                    </div>

                    <div class="pt-2 border-t border-gray-200">
                        <div class="flex items-center text-xs text-gray-600">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Fecha de registro: <span id="modalFecha"></span></span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button onclick="cerrarModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition duration-200">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarDetalle(historia, embarazo, hijos, fecha) {
            document.getElementById('modalHistoria').textContent = '#' + historia;
            document.getElementById('modalEmbarazo').textContent = embarazo;
            document.getElementById('modalHijos').textContent = hijos + (hijos == 1 ? ' hijo' : ' hijos');
            document.getElementById('modalFecha').textContent = fecha || 'Fecha no disponible';
            document.getElementById('modalDetalle').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modalDetalle').classList.add('hidden');
        }

        // Cerrar modal al hacer click fuera
        document.getElementById('modalDetalle').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });
    </script>
</x-app-layout>
