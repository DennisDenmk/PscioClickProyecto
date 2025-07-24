<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Estado Reproductivo - Historia Clínica #{{ $estado->est_his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        @php
            $historia = \App\Models\HistoriaClinica::with('paciente')->find($estado->est_his_id);
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

        <!-- Formulario de Edición -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-3 w-3 bg-orange-500 rounded-full"></div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-gray-800">Editar Estado Reproductivo</h4>
                        <p class="text-sm text-gray-600">Modifique la información del estado reproductivo del paciente</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('estado_reproductivo.update', $estado->est_id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Información de la Historia -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>
                                <div class="text-sm font-medium text-gray-700">Historia Clínica</div>
                                <div class="text-lg font-semibold text-gray-900">#{{ $estado->est_his_id }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Estado de Embarazo -->
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    ¿Está embarazada?
                                </span>
                            </label>
                            <select name="est_esta_embarazada"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring-2 focus:ring-[#0b5d63] focus:border-[#0b5d63] transition duration-200 @error('est_esta_embarazada') border-red-500 @enderror"
                                    required>
                                <option value="1" {{ $estado->est_esta_embarazada == 1 ? 'selected' : '' }}>
                                    Sí, está embarazada
                                </option>
                                <option value="0" {{ $estado->est_esta_embarazada == 0 ? 'selected' : '' }}>
                                    No está embarazada
                                </option>
                            </select>
                            @error('est_esta_embarazada')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Cantidad de Hijos -->
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Cantidad de hijos
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       name="est_cantidad_hijos"
                                       min="0"
                                       max="20"
                                       placeholder="Ingrese el número de hijos"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring-2 focus:ring-[#0b5d63] focus:border-[#0b5d63] transition duration-200 @error('est_cantidad_hijos') border-red-500 @enderror"
                                       value="{{ old('est_cantidad_hijos', $estado->est_cantidad_hijos) }}"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                            </div>
                            @error('est_cantidad_hijos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Ingrese 0 si no tiene hijos</p>
                        </div>
                    </div>

                    <!-- Información de registro -->
                    @if($estado->created_at)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800 mb-1">Información del registro</h4>
                                    <p class="text-sm text-blue-700">
                                        Registro creado el {{ $estado->created_at->format('d/m/Y \a \l\a\s H:i') }}
                                        @if($estado->updated_at && $estado->updated_at != $estado->created_at)
                                            <br>Última modificación: {{ $estado->updated_at->format('d/m/Y \a \l\a\s H:i') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-primarycolor-logo text-white font-medium rounded-lg hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Actualizar Estado Reproductivo
                        </button>

                        <a href="{{ route('estado_reproductivo.index', $estado->est_his_id) }}"
                           class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al Listado
                        </a>

                        <a href="{{ route('historia_clinica.home', $estado->est_his_id) }}"
                           class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            </svg>
                            Historia Clínica
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview de cambios -->
        <div class="mt-6 bg-orange-50 border border-orange-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-orange-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <div>
                    <h4 class="text-sm font-medium text-orange-800 mb-1">Modo de edición</h4>
                    <p class="text-sm text-orange-700">
                        Está modificando un registro existente. Los cambios se aplicarán al hacer clic en "Actualizar Estado Reproductivo".
                    </p>
                </div>
            </div>
        </div>

        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-red-800 mb-1">Por favor, corrija los siguientes errores:</h4>
                        <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Validación en tiempo real y confirmación de cambios
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const embarazadaSelect = document.querySelector('select[name="est_esta_embarazada"]');
            const hijosInput = document.querySelector('input[name="est_cantidad_hijos"]');

            // Valores originales para detectar cambios
            const originalEmbarazada = '{{ $estado->est_esta_embarazada }}';
            const originalHijos = '{{ $estado->est_cantidad_hijos }}';

            // Función para detectar cambios
            function hasChanges() {
                return embarazadaSelect.value !== originalEmbarazada ||
                       hijosInput.value !== originalHijos;
            }

            // Confirmación antes de enviar si hay cambios
            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Validar campos
                if (!embarazadaSelect.value) {
                    isValid = false;
                    embarazadaSelect.classList.add('border-red-500');
                } else {
                    embarazadaSelect.classList.remove('border-red-500');
                }

                if (!hijosInput.value || hijosInput.value < 0) {
                    isValid = false;
                    hijosInput.classList.add('border-red-500');
                } else {
                    hijosInput.classList.remove('border-red-500');
                }

                if (!isValid) {
                    e.preventDefault();

                    // Mostrar mensaje de error
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'mb-4 text-red-600 font-medium bg-red-100 border border-red-300 px-4 py-2 rounded-lg';
                    errorDiv.textContent = 'Por favor, complete todos los campos requeridos correctamente.';

                    const container = document.querySelector('.py-10');
                    const existingError = container.querySelector('.text-red-600');
                    if (existingError) {
                        existingError.remove();
                    }
                    container.insertBefore(errorDiv, container.firstElementChild.nextSibling);

                    // Scroll al top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    return;
                }

                // Confirmar si hay cambios
                if (hasChanges()) {
                    if (!confirm('¿Está seguro de que desea actualizar este estado reproductivo?')) {
                        e.preventDefault();
                    }
                }
            });

            // Remover error en tiempo real
            embarazadaSelect.addEventListener('change', function() {
                if (this.value) {
                    this.classList.remove('border-red-500');
                }
            });

            hijosInput.addEventListener('input', function() {
                if (this.value && this.value >= 0) {
                    this.classList.remove('border-red-500');
                }
            });

            // Advertir sobre cambios no guardados
            window.addEventListener('beforeunload', function(e) {
                if (hasChanges()) {
                    e.preventDefault();
                    e.returnValue = '¿Está seguro de que desea salir sin guardar los cambios?';
                }
            });
        });
    </script>
</x-app-layout>
