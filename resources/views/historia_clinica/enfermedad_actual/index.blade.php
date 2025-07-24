<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Enfermedades Actuales - Historia Clínica #{{ $historia->his_id }}
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

        <!-- Botón Registrar Enfermedad -->
        <div class="mb-6">
            <a href="{{ route('enfermedad_actual.create', $historia->his_id) }}"
                class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                Registrar Enfermedad Actual
            </a>
        </div>

        <!-- Enfermedades Actuales Registradas -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Enfermedades Actuales Registradas</h4>
            </div>

            @if($historia->enfermedadesActuales->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay enfermedades actuales registradas para esta historia clínica.
                    <div class="mt-2">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Enfermedad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($historia->enfermedadesActuales as $enf)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="h-3 w-3 bg-red-500 rounded-full"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $enf->tipoEnfermedad->tipo_enf_nombre }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($enf->enf_descripcion)
                                                <div class="max-w-xs">
                                                    {{ Str::limit($enf->enf_descripcion, 60) }}
                                                    @if(strlen($enf->enf_descripcion) > 60)
                                                        <span class="text-gray-400">...</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Sin descripción específica</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $enf->created_at ? $enf->created_at->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-900 font-medium"
                                                        onclick="mostrarDetalle('{{ $enf->tipoEnfermedad->tipo_enf_nombre }}', '{{ $enf->enf_descripcion }}')">
                                                    Ver Detalle
                                                </button>
                                                <form action="{{ route('enfermedad_actual.destroy', ['his_id' => $historia->his_id, 'id' => $enf->enf_id]) }}" method="POST" class="inline-block"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta enfermedad? Esta acción no se puede deshacer.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium ml-3">
                                                        Eliminar
                                                    </button>
                                                </form>
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
                        @foreach ($historia->enfermedadesActuales as $enf)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-3 w-3 bg-red-500 rounded-full mr-3"></div>
                                            <div class="font-medium text-gray-900">{{ $enf->tipoEnfermedad->tipo_enf_nombre }}</div>
                                        </div>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    </div>
                                    @if ($enf->enf_descripcion)
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Descripción</div>
                                            <div class="text-sm text-gray-900">{{ $enf->enf_descripcion }}</div>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            {{ $enf->created_at ? $enf->created_at->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200"
                                                    onclick="mostrarDetalle('{{ $enf->tipoEnfermedad->tipo_enf_nombre }}', '{{ $enf->enf_descripcion }}')">
                                                Ver Detalle
                                            </button>
                                            <form action="{{ route('enfermedad_actual.destroy', ['his_id' => $historia->his_id, 'id' => $enf->enf_id]) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta enfermedad?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition duration-200">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center flex-1">
                                        <div class="flex-shrink-0 h-3 w-3 bg-red-500 rounded-full mr-2"></div>
                                        <div class="font-medium text-gray-900 text-sm">
                                            {{ $enf->tipoEnfermedad->tipo_enf_nombre }}
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                </div>

                                @if ($enf->enf_descripcion)
                                    <div class="mb-3">
                                        <div class="text-sm text-gray-900">
                                            {{ Str::limit($enf->enf_descripcion, 80) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <div class="text-xs text-gray-600">
                                        {{ $enf->created_at ? $enf->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <div class="flex space-x-1">
                                        <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition duration-200"
                                                onclick="mostrarDetalle('{{ $enf->tipoEnfermedad->tipo_enf_nombre }}', '{{ $enf->enf_descripcion }}')">
                                            Ver
                                        </button>
                                        <form action="{{ route('enfermedad_actual.destroy', ['his_id' => $historia->his_id, 'id' => $enf->enf_id]) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Eliminar enfermedad?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700 transition duration-200">
                                                Eliminar
                                            </button>
                                        </form>
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
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-3 w-3 bg-red-500 rounded-full mr-3"></div>
                        <h3 class="text-lg font-medium text-gray-900" id="modalTitulo">Detalle de la Enfermedad</h3>
                    </div>
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
        function mostrarDetalle(tipoEnfermedad, descripcion) {
            document.getElementById('modalTitulo').textContent = tipoEnfermedad;
            document.getElementById('modalContenido').textContent = descripcion || 'Sin descripción específica registrada para esta enfermedad.';
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
