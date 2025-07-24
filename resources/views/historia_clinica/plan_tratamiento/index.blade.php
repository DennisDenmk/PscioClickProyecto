<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Planes de Tratamiento - Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
            <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm text-gray-600">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <!-- Botón Registrar Plan -->
        <div class="mb-6">
            <a href="{{ route('plan_tratamiento.create', $historia->his_id) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Registrar Plan de Tratamiento
            </a>
        </div>

        <!-- Planes de Tratamiento Registrados -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Planes de Tratamiento Registrados</h4>
            </div>

            @if($planes->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay planes de tratamiento registrados para esta historia clínica.
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnóstico</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Objetivo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tratamiento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Creación</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($planes as $plan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="h-3 w-3 bg-blue-500 rounded-full"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @if ($plan->pla_diagnostico)
                                                            {{ Str::limit($plan->pla_diagnostico, 40) }}
                                                            @if(strlen($plan->pla_diagnostico) > 40)
                                                                <span class="text-gray-400">...</span>
                                                            @endif
                                                        @else
                                                            <span class="text-gray-400 italic">Sin diagnóstico</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($plan->pla_objetivo_tratamiento)
                                                <div class="max-w-xs">
                                                    {{ Str::limit($plan->pla_objetivo_tratamiento, 50) }}
                                                    @if(strlen($plan->pla_objetivo_tratamiento) > 50)
                                                        <span class="text-gray-400">...</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Sin objetivo específico</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($plan->pla_tratamiento)
                                                <div class="max-w-xs">
                                                    {{ Str::limit($plan->pla_tratamiento, 50) }}
                                                    @if(strlen($plan->pla_tratamiento) > 50)
                                                        <span class="text-gray-400">...</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Sin tratamiento específico</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $plan->created_at ? $plan->created_at->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 font-medium"
                                                        onclick="mostrarDetalle('{{ $plan->pla_diagnostico }}', '{{ $plan->pla_objetivo_tratamiento }}', '{{ $plan->pla_tratamiento }}', '{{ $plan->created_at ? $plan->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                    Ver Detalle
                                                </button>
                                                <a href="{{ route('plan_tratamiento.edit', $plan->pla_id) }}"
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
                        @foreach ($planes as $plan)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-3 w-3 bg-blue-500 rounded-full mr-3"></div>
                                        <div class="font-medium text-gray-900">Plan de Tratamiento</div>
                                    </div>

                                    @if ($plan->pla_diagnostico)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Diagnóstico</div>
                                            <div class="text-sm text-gray-900">{{ $plan->pla_diagnostico }}</div>
                                        </div>
                                    @endif

                                    @if ($plan->pla_objetivo_tratamiento)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Objetivo</div>
                                            <div class="text-sm text-gray-900">{{ $plan->pla_objetivo_tratamiento }}</div>
                                        </div>
                                    @endif

                                    @if ($plan->pla_tratamiento)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Tratamiento</div>
                                            <div class="text-sm text-gray-900">{{ $plan->pla_tratamiento }}</div>
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            {{ $plan->created_at ? $plan->created_at->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200"
                                                    onclick="mostrarDetalle('{{ $plan->pla_diagnostico }}', '{{ $plan->pla_objetivo_tratamiento }}', '{{ $plan->pla_tratamiento }}', '{{ $plan->created_at ? $plan->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                                Ver Detalle
                                            </button>
                                            <a href="{{ route('plan_tratamiento.edit', $plan->pla_id) }}"
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
                                            Plan de Tratamiento
                                        </div>
                                    </div>
                                </div>

                                @if ($plan->pla_diagnostico)
                                    <div class="mb-2">
                                        <div class="text-xs font-medium text-gray-500">Diagnóstico:</div>
                                        <div class="text-sm text-gray-900">
                                            {{ Str::limit($plan->pla_diagnostico, 60) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-600">
                                        {{ $plan->created_at ? $plan->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <div class="flex space-x-1">
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition duration-200"
                                                onclick="mostrarDetalle('{{ $plan->pla_diagnostico }}', '{{ $plan->pla_objetivo_tratamiento }}', '{{ $plan->pla_tratamiento }}', '{{ $plan->created_at ? $plan->created_at->format('d/m/Y H:i') : 'N/A' }}')">
                                            Ver
                                        </button>
                                        <a href="{{ route('plan_tratamiento.edit', $plan->pla_id) }}"
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
            <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
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
                        <h3 class="text-lg font-medium text-gray-900">Detalle del Plan de Tratamiento</h3>
                    </div>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <div class="font-medium text-gray-700 mb-1">Diagnóstico:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalDiagnostico">
                            <!-- Contenido del diagnóstico -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Objetivo del Tratamiento:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalObjetivo">
                            <!-- Contenido del objetivo -->
                        </div>
                    </div>

                    <div>
                        <div class="font-medium text-gray-700 mb-1">Tratamiento:</div>
                        <div class="text-gray-900 bg-gray-50 p-3 rounded-lg" id="modalTratamiento">
                            <!-- Contenido del tratamiento -->
                        </div>
                    </div>

                    <div class="pt-2 border-t border-gray-200">
                        <div class="flex items-center text-xs text-gray-600">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Fecha de creación: <span id="modalFecha"></span></span>
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
        function mostrarDetalle(diagnostico, objetivo, tratamiento, fecha) {
            document.getElementById('modalDiagnostico').textContent = diagnostico || 'Sin diagnóstico registrado.';
            document.getElementById('modalObjetivo').textContent = objetivo || 'Sin objetivo específico registrado.';
            document.getElementById('modalTratamiento').textContent = tratamiento || 'Sin tratamiento específico registrado.';
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
