<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Añadir Antecedentes - Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 rounded-lg border-l-4 border-green-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 rounded-lg border-l-4 border-red-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Por favor corrige los siguientes errores:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
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

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-3 w-3 bg-orange-500 rounded-full mr-3"></div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Registro de Antecedentes</h3>
                        <p class="text-sm text-gray-600 mt-1">Añade los antecedentes médicos del paciente. Puedes agregar múltiples antecedentes usando el botón correspondiente.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('antecedentes.store', $his_id) }}" class="p-6">
                @csrf

                <!-- Contenedor de antecedentes dinámicos -->
                <div id="antecedentes-container" class="space-y-6 mb-6">
                    <!-- Los antecedentes se añadirán aquí dinámicamente -->
                </div>

                <!-- Mensaje cuando no hay antecedentes -->
                <div id="mensaje-vacio" class="p-8 text-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50" style="display: none;">
                    <div class="text-gray-500 mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h10l2 2h9a2 2 0 012 2v1M9 12v7a2 2 0 002 2h10m-12-4h6m-6 4h6"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No hay antecedentes agregados</p>
                    <p class="text-sm text-gray-400 mt-2">Haz clic en "Añadir Antecedente" para comenzar</p>
                </div>

                <!-- Botones de acción -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row gap-3 justify-between">
                        <button type="button"
                                onclick="agregarAntecedente()"
                                class="inline-flex items-center px-6 py-3 border-2 border-primarycolor-logo text-primarycolor-logo bg-white rounded-lg hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 font-medium shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Añadir Antecedente
                        </button>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('historia_clinica.home', $his_id) }}"
                               class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                    id="boton-guardar"
                                    disabled
                                    class="inline-flex items-center justify-center px-6 py-3 bg-primarycolor-logo text-white rounded-lg hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Guardar Antecedentes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let contador = 0;
        let totalAntecedentes = 0;

        function agregarAntecedente() {
            const container = document.getElementById('antecedentes-container');
            const index = contador++;
            totalAntecedentes++;

            const div = document.createElement('div');
            div.className = 'relative p-6 border-2 border-dashed border-orange-200 rounded-lg bg-gradient-to-r from-orange-50 to-yellow-50 hover:from-orange-100 hover:to-yellow-100 transition-all duration-300 shadow-sm hover:shadow-md';
            div.setAttribute('data-index', index);

            div.innerHTML = `
                <!-- Botón eliminar -->
                <button type="button"
                        onclick="eliminarAntecedente(this)"
                        class="absolute top-4 right-4 w-8 h-8 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 flex items-center justify-center text-sm font-bold shadow-sm z-10"
                        title="Eliminar antecedente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="pr-12">
                    <!-- Contador visual -->
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-orange-500 to-yellow-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-md">
                            ${totalAntecedentes}
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Antecedente ${totalAntecedentes}</h4>
                            <p class="text-sm text-gray-600">Complete la información del antecedente médico</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Tipo de Antecedente -->
                        <div>
                            <label for="antecedentes_${index}_tipo_ant_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    Tipo de Antecedente
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <select name="antecedentes[${index}][tipo_ant_id]"
                                    id="antecedentes_${index}_tipo_ant_id"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent text-sm transition duration-200"
                                    required>
                                <option value="">-- Selecciona un tipo de antecedente --</option>
                                @foreach ($tiposAntecedentes as $tipo)
                                    <option value="{{ $tipo->tipa_id }}">{{ $tipo->tipa_nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Detalle -->
                        <div>
                            <label for="antecedentes_${index}_ant_detalle" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Detalle del Antecedente
                                    <span class="text-gray-400 ml-1">(opcional)</span>
                                </div>
                            </label>
                            <textarea name="antecedentes[${index}][ant_detalle]"
                                      id="antecedentes_${index}_ant_detalle"
                                      rows="4"
                                      placeholder="Ej: duración (años), medicamentos utilizados, cirugías previas, complicaciones, observaciones relevantes..."
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent text-sm resize-vertical transition duration-200"></textarea>
                            <div class="mt-2 flex items-start">
                                <svg class="w-4 h-4 mr-1 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-xs text-gray-600">Incluye información relevante como tiempo de evolución, tratamientos previos, complicaciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(div);
            actualizarEstadoFormulario();

            // Animación de entrada suave
            div.style.opacity = '0';
            div.style.transform = 'translateY(20px)';
            setTimeout(() => {
                div.style.transition = 'all 0.3s ease-out';
                div.style.opacity = '1';
                div.style.transform = 'translateY(0)';
            }, 50);

            // Scroll suave hacia el nuevo elemento
            setTimeout(() => {
                div.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                // Focus en el select del nuevo antecedente
                div.querySelector('select').focus();
            }, 300);
        }

        function eliminarAntecedente(boton) {
            // Confirmación antes de eliminar
            if (confirm('¿Estás seguro de que deseas eliminar este antecedente?')) {
                const div = boton.closest('div[data-index]');
                div.style.transition = 'all 0.3s ease-out';
                div.style.transform = 'scale(0.95) translateX(20px)';
                div.style.opacity = '0';

                setTimeout(() => {
                    div.remove();
                    totalAntecedentes--;
                    actualizarNumeracionAntecedentes();
                    actualizarEstadoFormulario();
                }, 300);
            }
        }

        function actualizarNumeracionAntecedentes() {
            const antecedentesContainer = document.getElementById('antecedentes-container');
            const antecedentes = antecedentesContainer.querySelectorAll('div[data-index]');

            antecedentes.forEach((antecedente, index) => {
                const contador = antecedente.querySelector('.bg-gradient-to-r.from-orange-500');
                const titulo = antecedente.querySelector('h4');
                if (contador && titulo) {
                    contador.textContent = index + 1;
                    titulo.textContent = `Antecedente ${index + 1}`;
                }
            });
        }

        function actualizarEstadoFormulario() {
            const container = document.getElementById('antecedentes-container');
            const mensajeVacio = document.getElementById('mensaje-vacio');
            const botonGuardar = document.getElementById('boton-guardar');

            if (totalAntecedentes === 0) {
                mensajeVacio.style.display = 'block';
                botonGuardar.disabled = true;
            } else {
                mensajeVacio.style.display = 'none';
                botonGuardar.disabled = false;
            }
        }

        // Inicializar con un antecedente al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            agregarAntecedente();
        });

        // Validación antes de enviar el formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const selects = document.querySelectorAll('select[name*="tipo_ant_id"]');
            let valid = true;
            let firstInvalid = null;

            selects.forEach(select => {
                if (!select.value) {
                    valid = false;
                    select.classList.add('border-red-500', 'bg-red-50');
                    select.classList.remove('border-gray-300');
                    if (!firstInvalid) {
                        firstInvalid = select;
                    }
                } else {
                    select.classList.remove('border-red-500', 'bg-red-50');
                    select.classList.add('border-gray-300');
                }
            });

            if (!valid) {
                e.preventDefault();

                // Crear modal de error más elegante
                const errorModal = document.createElement('div');
                errorModal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
                errorModal.innerHTML = `
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
                        <div class="mt-3">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-medium text-gray-900">Campos Requeridos</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">
                                Por favor, selecciona un tipo de antecedente para todos los campos obligatorios antes de continuar.
                            </p>
                            <div class="flex justify-end">
                                <button onclick="this.closest('.fixed').remove()"
                                        class="px-4 py-2 bg-primarycolor-logo text-white rounded-lg hover:bg-[#09494e] transition duration-200">
                                    Entendido
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                document.body.appendChild(errorModal);

                // Focus en el primer campo inválido
                if (firstInvalid) {
                    setTimeout(() => {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }, 100);
                }

                return false;
            }
        });

        // Remover estilos de error cuando se selecciona un valor válido
        document.addEventListener('change', function(e) {
            if (e.target.matches('select[name*="tipo_ant_id"]') && e.target.value) {
                e.target.classList.remove('border-red-500', 'bg-red-50');
                e.target.classList.add('border-gray-300');
            }
        });
    </script>
</x-app-layout>
