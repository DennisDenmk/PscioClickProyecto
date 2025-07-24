<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Registrar Estado Reproductivo - Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        @if (isset($historia) && $historia->paciente)
            <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
                <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                    Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
                </h3>
                <p class="text-sm text-gray-600">Cédula: {{ $historia->paciente->pac_cedula }}</p>
            </div>
        @endif

        <!-- Formulario de Registro -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-3 w-3 bg-blue-500 rounded-full"></div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-gray-800">Nuevo Estado Reproductivo</h4>
                        <p class="text-sm text-gray-600">Complete la información del estado reproductivo del paciente</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('estado_reproductivo.store', $historia->his_id) }}" class="space-y-6">
                    @csrf

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
                                <option value="">-- Seleccione una opción --</option>
                                <option value="1" {{ old('est_esta_embarazada') == '1' ? 'selected' : '' }}>
                                    Sí, está embarazada
                                </option>
                                <option value="0" {{ old('est_esta_embarazada') == '0' ? 'selected' : '' }}>
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
                                       value="{{ old('est_cantidad_hijos') }}"
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

                    <!-- Información adicional -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-1">Información importante</h4>
                                <p class="text-sm text-blue-700">
                                    Esta información será registrada en la historia clínica del paciente y podrá ser consultada por el personal médico autorizado.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-primarycolor-logo text-white font-medium rounded-lg hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar Estado Reproductivo
                        </button>

                        <a href="{{ route('estado_reproductivo.index', $historia->his_id) }}"
                           class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al Listado
                        </a>

                        <a href="{{ route('historia_clinica.home', $historia->his_id) }}"
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

        <!-- Preview de datos (solo si hay errores de validación) -->
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
        // Validación en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const embarazadaSelect = document.querySelector('select[name="est_esta_embarazada"]');
            const hijosInput = document.querySelector('input[name="est_cantidad_hijos"]');

            // Validación del formulario
            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Validar selección de embarazo
                if (!embarazadaSelect.value) {
                    isValid = false;
                    embarazadaSelect.classList.add('border-red-500');
                } else {
                    embarazadaSelect.classList.remove('border-red-500');
                }

                // Validar cantidad de hijos
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
        });
    </script>
</x-app-layout>
