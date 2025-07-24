<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Evaluación - Historia Clínica #{{ $evaluacion->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 rounded-lg border-l-4 border-red-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Se encontraron los siguientes errores:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
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
            $historia = \App\Models\HistoriaClinica::with('paciente')->find($evaluacion->his_id);
            $pacienteInfo = $historia ? $historia->paciente : null;
        @endphp

        @if ($pacienteInfo)
            <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
                <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                    Paciente: {{ $pacienteInfo->pac_nombres }} {{ $pacienteInfo->pac_apellidos }}
                </h3>
                <p class="text-sm text-gray-600">Cédula: {{ $pacienteInfo->pac_cedula }}</p>
                <div class="mt-2 flex items-center text-xs text-gray-500">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Evaluación registrada: {{ $evaluacion->created_at ? $evaluacion->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
            </div>
        @endif

        <!-- Formulario Principal -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-3 w-3 bg-green-500 rounded-full mr-3"></div>
                    <h4 class="text-lg font-semibold text-gray-800">Editar Evaluación</h4>
                </div>
            </div>

            <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->eva_id) }}" class="p-6">
                @csrf
                @method('PUT')

                <!-- Evaluación de Dolor -->
                <div class="mb-6">
                    <label for="eva_evaluacion_dolor" class="block text-sm font-medium text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Evaluación de Dolor *
                        </div>
                    </label>
                    <input type="text"
                           id="eva_evaluacion_dolor"
                           name="eva_evaluacion_dolor"
                           value="{{ old('eva_evaluacion_dolor', $evaluacion->eva_evaluacion_dolor) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 @error('eva_evaluacion_dolor') border-red-300 bg-red-50 @enderror"
                           placeholder="Describa la evaluación del dolor del paciente..."
                           required>
                    @error('eva_evaluacion_dolor')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Escala de Dolor con Visualización -->
                <div class="mb-6">
                    <label for="eva_escala_dolor" class="block text-sm font-medium text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Escala de Dolor (0 a 10) *
                        </div>
                    </label>

                    <!-- Mostrar valor actual vs original -->
                    <div class="mb-3 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-blue-800">Valor original:
                                <span class="font-semibold">{{ $evaluacion->eva_escala_dolor ?? 0 }}/10</span>
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <input type="number"
                               id="eva_escala_dolor"
                               name="eva_escala_dolor"
                               min="0"
                               max="10"
                               value="{{ old('eva_escala_dolor', $evaluacion->eva_escala_dolor) }}"
                               class="w-full sm:w-32 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 @error('eva_escala_dolor') border-red-300 bg-red-50 @enderror"
                               onchange="actualizarVisualizacionDolor(this.value)"
                               required>

                        <!-- Visualización de la escala -->
                        <div class="flex items-center">
                            <span id="dolor-badge" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mr-3">
                                <span id="dolor-valor">{{ old('eva_escala_dolor', $evaluacion->eva_escala_dolor) }}</span>/10
                            </span>
                            <div class="flex space-x-1" id="dolor-circles">
                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="w-3 h-3 rounded-full {{ $i <= old('eva_escala_dolor', $evaluacion->eva_escala_dolor) ? 'bg-red-400' : 'bg-gray-200' }}" data-nivel="{{ $i }}"></div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    @error('eva_escala_dolor')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror

                    <!-- Guía de interpretación -->
                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                        <div class="text-xs text-gray-600 mb-2 font-medium">Guía de interpretación:</div>
                        <div class="flex flex-wrap gap-2 text-xs">
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800">0-3: Leve</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">4-6: Moderado</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-800">7-10: Severo</span>
                        </div>
                    </div>
                </div>

                <!-- Exámenes Complementarios -->
                <div class="mb-6">
                    <label for="eva_examenes_complementarios" class="block text-sm font-medium text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                            Exámenes Complementarios
                        </div>
                    </label>
                    <textarea id="eva_examenes_complementarios"
                              name="eva_examenes_complementarios"
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 resize-vertical"
                              placeholder="Describa los exámenes complementarios realizados o requeridos...">{{ old('eva_examenes_complementarios', $evaluacion->eva_examenes_complementarios) }}</textarea>
                    <div class="mt-1 text-xs text-gray-500">
                        Opcional: Incluya detalles sobre exámenes de laboratorio, imagenología u otros estudios relevantes.
                    </div>
                </div>

                <!-- Información de última modificación -->
                <div class="mb-6 p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-400">
                    <div class="flex items-center text-sm text-yellow-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>
                            @if($evaluacion->updated_at && $evaluacion->updated_at != $evaluacion->created_at)
                                Última modificación: {{ $evaluacion->updated_at->format('d/m/Y H:i') }}
                            @else
                                Esta evaluación no ha sido modificada desde su creación
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 bg-primarycolor-logo text-white rounded-lg font-medium hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Actualizar Evaluación
                    </button>

                    <a href="{{ route('evaluaciones.index', $evaluacion->his_id) }}"
                       class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Cancelar
                    </a>

                    <!-- Botón de eliminación (opcional - si tienes esta funcionalidad) -->
                    <button type="button"
                            onclick="confirmarEliminacion()"
                            class="inline-flex items-center justify-center px-6 py-3 border border-red-300 rounded-lg text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function actualizarVisualizacionDolor(valor) {
            const valorNum = parseInt(valor) || 0;
            const badge = document.getElementById('dolor-badge');
            const valorSpan = document.getElementById('dolor-valor');
            const circles = document.querySelectorAll('#dolor-circles div');

            // Actualizar valor
            valorSpan.textContent = valorNum;

            // Actualizar color del badge
            let colorClass = '';
            if (valorNum <= 3) {
                colorClass = 'bg-green-100 text-green-800';
            } else if (valorNum <= 6) {
                colorClass = 'bg-yellow-100 text-yellow-800';
            } else {
                colorClass = 'bg-red-100 text-red-800';
            }

            badge.className = `inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mr-3 ${colorClass}`;

            // Actualizar círculos
            circles.forEach((circle, index) => {
                const nivel = index + 1;
                if (nivel <= valorNum) {
                    circle.className = 'w-3 h-3 rounded-full bg-red-400 transition-colors duration-200';
                } else {
                    circle.className = 'w-3 h-3 rounded-full bg-gray-200 transition-colors duration-200';
                }
            });
        }

        function confirmarEliminacion() {
            if (confirm('¿Está seguro de que desea eliminar esta evaluación? Esta acción no se puede deshacer.')) {
                // Crear formulario de eliminación dinámico
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("evaluaciones.destroy", $evaluacion->eva_id) }}';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Inicializar la visualización al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('eva_escala_dolor');
            if (input && input.value) {
                actualizarVisualizacionDolor(input.value);
            }
        });
    </script>
</x-app-layout>
