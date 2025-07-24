<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Hábitos - Historia Clínica #{{ $historia->his_id }}
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

        <!-- Botón Registrar Hábitos -->
        <div class="mb-6">
            <a href="{{ route('habitos.create', $historia->his_id) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Registrar Hábitos
            </a>
        </div>

        <!-- Hábitos Registrados -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Hábitos Registrados</h4>
            </div>

            @if($historia->habitos->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay hábitos registrados para esta historia clínica.
                </div>
            @else
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Hábito</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalle</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($historia->habitos as $habito)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-3 w-3 bg-green-500 rounded-full mr-3"></div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $habito->tipoHabito->tipo_hab_nombre }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($habito->hab_detalle)
                                                <div class="max-w-xs">
                                                    {{ Str::limit($habito->hab_detalle, 60) }}
                                                    @if(strlen($habito->hab_detalle) > 60)
                                                        <span class="text-gray-400">...</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Sin detalle específico</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $habito->created_at ? $habito->created_at->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <button class="text-blue-600 hover:text-blue-900 font-medium"
                                                    onclick="mostrarDetalle('{{ $habito->tipoHabito->tipo_hab_nombre }}', '{{ $habito->hab_detalle }}')">
                                                Ver Detalle
                                            </button>
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
                        @foreach ($historia->habitos as $habito)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-3 w-3 bg-green-500 rounded-full mr-3"></div>
                                        <div class="font-medium text-gray-900">{{ $habito->tipoHabito->tipo_hab_nombre }}</div>
                                    </div>
                                    @if ($habito->hab_detalle)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Detalle</div>
                                            <div class="text-sm text-gray-900">{{ $habito->hab_detalle }}</div>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            {{ $habito->created_at ? $habito->created_at->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200"
                                                onclick="mostrarDetalle('{{ $habito->tipoHabito->tipo_hab_nombre }}', '{{ $habito->hab_detalle }}')">
                                            Ver Detalle
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center flex-1">
                                        <div class="flex-shrink-0 h-3 w-3 bg-green-500 rounded-full mr-2"></div>
                                        <div class="font-medium text-gray-900 text-sm">
                                            {{ $habito->tipoHabito->tipo_hab_nombre }}
                                        </div>
                                    </div>
                                </div>

                                @if ($habito->hab_detalle)
                                    <div class="mb-3">
                                        <div class="text-sm text-gray-900">
                                            {{ Str::limit($habito->hab_detalle, 80) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-600">
                                        {{ $habito->created_at ? $habito->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition duration-200"
                                            onclick="mostrarDetalle('{{ $habito->tipoHabito->tipo_hab_nombre }}', '{{ $habito->hab_detalle }}')">
                                        Ver
                                    </button>
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
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitulo">Detalle del Hábito</h3>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-700" id="modalContenido">
                    <!-- Contenido del modal -->
                </div>
                <div class="mt-4 flex justify-end">
                    <button onclick="cerrarModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition duration-200">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarDetalle(tipoHabito, detalle) {
            document.getElementById('modalTitulo').textContent = tipoHabito;
            document.getElementById('modalContenido').textContent = detalle || 'Sin detalle específico registrado.';
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
