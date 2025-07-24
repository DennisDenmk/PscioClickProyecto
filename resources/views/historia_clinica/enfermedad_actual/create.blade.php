<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Registrar Enfermedad Actual - Historia Clínica #{{ $his_id }}
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
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Registrando enfermedades para el paciente
            </h3>
            <p class="text-sm text-gray-600">Complete la información de las enfermedades actuales del paciente</p>
        </div>

        <!-- Formulario Principal -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Enfermedades Actuales
                    </h4>
                    <div class="text-sm text-gray-600">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium" id="contador-enfermedades">
                            0 enfermedades agregadas
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('enfermedad_actual.store', $his_id) }}" class="p-6">
                @csrf

                <!-- Contenedor de enfermedades -->
                <div id="enfermedades-container" class="space-y-6 mb-6">
                    <!-- Las enfermedades se agregan aquí dinámicamente -->
                </div>

                <!-- Estado vacío inicial -->
                <div id="estado-vacio" class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay enfermedades agregadas</h3>
                    <p class="mt-1 text-sm text-gray-500">Comience agregando la primera enfermedad actual del paciente</p>
                </div>

                <!-- Botón Agregar Enfermedad -->
                <div class="mb-6">
                    <button type="button" onclick="agregarEnfermedad()"
                            class="bg-primarycolor-logo text-white px-4 py-2 rounded-lg font-medium hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Añadir Enfermedad
                    </button>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" id="btn-guardar" disabled
                            class="inline-flex items-center px-6 py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Guardar Enfermedades
                    </button>

                    <a href="{{ route('historia_clinica.home', $his_id) }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancelar
                    </a>
                </div>
            </form>
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

    <script>
        let contador = 0;

        function agregarEnfermedad() {
            const container = document.getElementById('enfermedades-container');
            const estadoVacio = document.getElementById('estado-vacio');
            const btnGuardar = document.getElementById('btn-guardar');
            const index = contador++;

            // Ocultar estado vacío
            if (estadoVacio) {
                estadoVacio.style.display = 'none';
            }

            // Crear nueva enfermedad
            const div = document.createElement('div');
            div.className = 'bg-gray-50 rounded-lg p-6 border border-gray-200 hover:border-[#0b5d63] transition duration-200 relative';
            div.id = `enfermedad-${index}`;

            div.innerHTML = `
                <!-- Indicador numérico -->
                <div class="absolute -left-2 -top-2 w-8 h-8 bg-[#0b5d63] text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
                    ${index + 1}
                </div>

                <!-- Botón eliminar -->
                <button type="button" onclick="eliminarEnfermedad(${index})"
                        class="absolute top-3 right-3 w-8 h-8 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 hover:text-red-700 transition-all duration-200 flex items-center justify-center"
                        title="Eliminar enfermedad">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pr-12">
                    <!-- Tipo de Enfermedad -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Tipo de Enfermedad *
                        </label>
                        <select name="enfermedades[${index}][enf_tipo_id]"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200"
                                required>
                            <option value="">-- Seleccione un tipo --</option>
                            @foreach ($tiposEnfermedad as $tipo)
                                <option value="{{ $tipo->tipo_enf_id }}">{{ $tipo->tipo_enf_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="lg:col-span-1">
                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Descripción *
                        </label>
                        <textarea name="enfermedades[${index}][enf_descripcion]"
                                  rows="3"
                                  placeholder="Describa los síntomas, características o detalles relevantes de la enfermedad..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 resize-none"
                                  required></textarea>
                    </div>
                </div>
            `;

            container.appendChild(div);
            actualizarContador();
            habilitarBotonGuardar();

            // Scroll suave hacia la nueva enfermedad
            setTimeout(() => {
                div.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        }

        function eliminarEnfermedad(index) {
            if (confirm('¿Está seguro de que desea eliminar esta enfermedad del formulario?')) {
                const enfermedad = document.getElementById(`enfermedad-${index}`);
                if (enfermedad) {
                    enfermedad.remove();
                    actualizarContador();
                    verificarEstadoVacio();
                    habilitarBotonGuardar();
                }
            }
        }

        function actualizarContador() {
            const container = document.getElementById('enfermedades-container');
            const contador = container.children.length;
            const contadorElement = document.getElementById('contador-enfermedades');

            if (contadorElement) {
                contadorElement.textContent = `${contador} enfermedad${contador !== 1 ? 'es' : ''} agregada${contador !== 1 ? 's' : ''}`;

                // Cambiar color según cantidad
                contadorElement.className = contador > 0
                    ? 'bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium'
                    : 'bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium';
            }

            // Renumerar los indicadores
            Array.from(container.children).forEach((child, idx) => {
                const indicador = child.querySelector('div:first-child');
                if (indicador) {
                    indicador.textContent = idx + 1;
                }
            });
        }

        function verificarEstadoVacio() {
            const container = document.getElementById('enfermedades-container');
            const estadoVacio = document.getElementById('estado-vacio');

            if (container.children.length === 0) {
                estadoVacio.style.display = 'block';
            }
        }

        function habilitarBotonGuardar() {
            const container = document.getElementById('enfermedades-container');
            const btnGuardar = document.getElementById('btn-guardar');

            if (container.children.length > 0) {
                btnGuardar.disabled = false;
                btnGuardar.className = 'inline-flex items-center px-6 py-3 bg-[#0b5d63] text-white font-medium rounded-lg hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md';
            } else {
                btnGuardar.disabled = true;
                btnGuardar.className = 'inline-flex items-center px-6 py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed transition duration-200';
            }
        }

        // Agregar primera enfermedad al cargar la página
        window.onload = function() {
            agregarEnfermedad();
        };
    </script>
</x-app-layout>
