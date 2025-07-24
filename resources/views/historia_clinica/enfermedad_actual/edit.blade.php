<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Enfermedad Actual - Historia Clínica #{{ $enfermedad->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Se encontraron errores:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Información del Paciente -->
        <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
            <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editando enfermedad actual
            </h3>
            <p class="text-sm text-gray-600">Modifique la información de la enfermedad seleccionada</p>
        </div>

        <!-- Formulario Principal -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Información de la Enfermedad
                    </h4>
                    <div class="text-sm text-gray-600">
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                            Modo Edición
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('enfermedad_actual.update', $enfermedad->enf_id) }}" class="p-6">
                @csrf
                @method('PUT')

                <!-- Contenedor de la enfermedad -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:border-[#0b5d63] transition duration-200 relative">
                    <!-- Indicador de enfermedad -->
                    <div class="absolute -left-2 -top-2 w-8 h-8 bg-[#0b5d63] text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>

                    <!-- Información actual -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h5 class="text-sm font-medium text-blue-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Información Actual
                        </h5>
                        <div class="text-sm text-blue-700">
                            <p><strong>Tipo:</strong> {{ $enfermedad->tipoEnfermedad->tipo_enf_nombre ?? 'No especificado' }}</p>
                            <p class="mt-1"><strong>Registrado:</strong> {{ $enfermedad->created_at ? $enfermedad->created_at->format('d/m/Y H:i') : 'Fecha no disponible' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Tipo de Enfermedad -->
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Tipo de Enfermedad *
                            </label>
                            <select name="enf_tipo_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 @error('enf_tipo_id') border-red-300 @enderror"
                                    required>
                                <option value="">-- Seleccione un tipo --</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->tipo_enf_id }}" @selected($enfermedad->enf_tipo_id == $tipo->tipo_enf_id)>
                                        {{ $tipo->tipo_enf_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('enf_tipo_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="lg:col-span-1">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-[#0b5d63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Descripción *
                            </label>
                            <textarea name="enf_descripcion"
                                      rows="4"
                                      placeholder="Describa los síntomas, características o detalles relevantes de la enfermedad..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b5d63] focus:border-transparent transition duration-200 resize-none @error('enf_descripcion') border-red-300 @enderror"
                                      required>{{ old('enf_descripcion', $enfermedad->enf_descripcion) }}</textarea>
                            @error('enf_descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Información adicional -->
                    <div class="mt-4 p-3 bg-gray-100 rounded-lg">
                        <div class="flex items-center text-xs text-gray-600">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Última actualización: {{ $enfermedad->updated_at ? $enfermedad->updated_at->format('d/m/Y H:i') : 'Sin actualizaciones' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-[#0b5d63] text-white font-medium rounded-lg hover:bg-[#09494e] transition duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar Enfermedad
                    </button>

                    <a href="{{ route('enfermedad_actual.index', $enfermedad->his_id) }}"
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
            <a href="{{ route('enfermedad_actual.index', $enfermedad->his_id) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Enfermedades
            </a>
            <a href="{{ route('historia_clinica.home', $enfermedad->his_id) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                </svg>
                Historia Clínica
            </a>
        </div>
    </div>
</x-app-layout>
