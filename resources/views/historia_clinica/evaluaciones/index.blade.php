<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Evaluaciones - Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        @php
            $historia = \App\Models\HistoriaClinica::with('paciente')->find($his_id);
            $pacienteInfo = $historia ? $historia->paciente : null;
        @endphp

        @if ($pacienteInfo)
            <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
                <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                    Paciente: {{ $pacienteInfo->pac_nombres }} {{ $pacienteInfo->pac_apellidos }}
                </h3>
                <p class="text-sm text-gray-600">Cédula: {{ $pacienteInfo->pac_cedula }}</p>
            </div>
        @endif

        <!-- Botón Registrar Evaluación -->
        <div class="mb-6">
            <a href="{{ route('evaluaciones.create', $his_id) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Registrar Nueva Evaluación
            </a>
        </div>

        <!-- Evaluaciones Registradas -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Evaluaciones Registradas</h4>
            </div>

            @if($evaluaciones->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay evaluaciones registradas para esta historia clínica.
                    <div class="mt-2">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evaluación del Dolor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Escala de Dolor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exámenes Complementarios</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($evaluaciones as $eva)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="h-3 w-3 bg-blue-500 rounded-full"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @if ($eva->eva_evaluacion_dolor)
                                                            {{ Str::limit($eva->eva_evaluacion_dolor, 40) }}
                                                            @if(strlen($eva->eva_evaluacion_dolor) > 40)
                                                                <span class="text-gray-400">...</span>
                                                            @endif
                                                        @else
                                                            <span class="text-gray-400 italic">Sin evaluación específica</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="flex items-center">
                                                @php
                                                    $dolor = $eva->eva_escala_dolor ?? 0;
                                                    $colorClass = $dolor <= 3 ? 'bg-green-100 text-green-800' :
                                                                ($dolor <= 6 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                                @endphp
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                                    {{ $dolor }}/10
                                                </span>
                                                <div class="ml-2 flex space-x-1">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <div class="w-2 h-2 rounded-full {{ $i <= $dolor ? 'bg-red-400' : 'bg-gray-200' }}"></div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($eva->eva_examenes_complementarios)
                                                <div class="max-w-xs">
                                                    {{ Str::limit($eva->eva_examenes_complementarios, 30) }}
                                                    @if(strlen($eva->eva_examenes_complementarios) > 30)
                                                        <span class="text-gray-400">...</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Sin exámenes registrados</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $eva->created_at ? $eva->created_at->format('d/m/Y H:i') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 font-medium"
                                                        onclick="mostrarDetalle('{{ addslashes($eva->eva_evaluacion_dolor) }}', '{{ $eva->eva_escala_dolor }}', '{{ addslashes($eva->eva_examenes_complementarios) }}', '{{ $eva->created_at ? $eva->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                    Ver Detalle
                                                </button>
                                                <a href="{{ route('evaluaciones.edit', $eva->eva_id) }}"
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
                        @foreach ($evaluaciones as $eva)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-3 w-3 bg-blue-500 rounded-full mr-3"></div>
                                        <div class="font-medium text-gray-900">Evaluación de Dolor</div>
                                    </div>

                                    @if ($eva->eva_evaluacion_dolor)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Descripción del Dolor</div>
                                            <div class="text-sm text-gray-900">{{ $eva->eva_evaluacion_dolor }}</div>
                                        </div>
                                    @endif

                                    <div>
                                        <div class="text-sm font-medium text-gray-500 mb-1">Escala de Dolor</div>
                                        <div class="flex items-center">
                                            @php
                                                $dolor = $eva->eva_escala_dolor ?? 0;
                                                $colorClass = $dolor <= 3 ? 'bg-green-100 text-green-800' :
                                                            ($dolor <= 6 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }} mr-2">
                                                {{ $dolor }}/10
                                            </span>
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <div class="w-2 h-2 rounded-full {{ $i <= $dolor ? 'bg-red-400' : 'bg-gray-200' }}"></div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    @if ($eva->eva_examenes_complementarios)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Exámenes Complementarios</div>
                                            <div class="text-sm text-gray-900">{{ $eva->eva_examenes_complementarios }}</div>
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            {{ $eva->created_at ? $eva->created_at->format('d/m/Y H:i') : 'N/A' }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200"
                                                    onclick="mostrarDetalle('{{ addslashes($eva->eva_evaluacion_dolor) }}', '{{ $eva->eva_escala_dolor }}', '{{ addslashes($eva->eva_examenes_complementarios) }}', '{{ $eva->created_at ? $eva->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                Ver Detalle
                                            </button>
                                            <a href="{{ route('evaluaciones.edit', $eva->eva_id) }}"
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
                                            Evaluación de Dolor
                                        </div>
                                    </div>
                                </div>

                                @if ($eva->eva_evaluacion_dolor)
                                    <div class="mb-2">
                                        <div class="text-xs font-medium text-gray-500">Descripción:</div>
                                        <div class="text-sm text-gray-900">
                                            {{ Str::limit($eva->eva_evaluacion_dolor, 60) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-2">
                                    @php
                                        $dolor = $eva->eva_escala_dolor ?? 0;
                                        $colorClass = $dolor <= 3 ? 'bg-green-100 text-green-800' :
                                                    ($dolor <= 6 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                        Dolor: {{ $dolor }}/10
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-600">
                                        {{ $eva->created_at ? $eva->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <div class="flex space-x-1">
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition duration-200"
                                                onclick="mostrarDetalle('{{ addslashes($eva->eva_evaluacion_dolor) }}', '{{ $eva->eva_escala_dolor }}', '{{ addslashes($eva->eva_examenes_complementarios) }}', '{{ $eva->created_at ? $eva->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                            Ver
                                        </button>
                                        <a href="{{ route('evaluaciones.edit', $eva->eva_id) }}"
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
            <a href="{{ route('historia_clinica.home', $his_id) }}"
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
                        <h3 class="text-lg font-medium text-gray-900">Detalle de la Evaluación</h3>
                    </div>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <div class="font-medium text-gray-700 mb-1">Evaluación del Dolor:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalEvaluacion">
                            <!-- Contenido de la evaluación -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Escala de Dolor:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalEscala">
                            <!-- Contenido de la escala -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Exámenes Complementarios:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalExamenes">
                            <!-- Contenido de los exámenes -->
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
        function mostrarDetalle(evaluacion, escala, examenes, fecha) {
            document.getElementById('modalEvaluacion').textContent = evaluacion || 'Sin evaluación específica registrada.';
            document.getElementById('modalEscala').textContent = (escala || '0') + '/10';
            document.getElementById('modalExamenes').textContent = examenes || 'Sin exámenes complementarios registrados.';
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
