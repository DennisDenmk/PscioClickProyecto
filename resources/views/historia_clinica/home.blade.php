<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Detalles de Historia Clínica #{{ $historia->his_id }} prueba
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Información del Paciente -->
        <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl shadow-sm border border-emerald-200">
            <div class="p-6 border-l-4 border-emerald-600">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-slate-800 mb-1">
                            {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
                        </h3>
                        <p class="text-emerald-700 font-medium">Cédula: {{ $historia->paciente->pac_cedula }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Navegación -->
        @rol('doctor')
        <div class="mb-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <a href="{{ route('historias.show', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Consultas</span>
                </a>
                
                <a href="{{ route('habitos.show', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Hábitos</span>
                </a>
                
                <a href="{{ route('antecedentes.show', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Antecedentes</span>
                </a>
                
                <a href="{{ route('enfermedad_actual.index', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Enfermedad Actual</span>
                </a>
                
                <a href="{{ route('plan_tratamiento.index', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Plan de Tratamiento</span>
                </a>
                
                <a href="{{ route('estado_reproductivo.index', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Estado Reproductivo</span>
                </a>
                
                <a href="{{ route('evaluaciones.index', $historia->his_id) }}"
                   class="group relative bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                    <span class="relative z-10">Evaluaciones</span>
                </a>
            </div>
        </div>
        @endrol

        <!-- Resumen de Historia Clínica -->
        <div class="space-y-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-800 mb-2">Resumen de Historia Clínica</h1>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 mx-auto rounded-full"></div>
            </div>

            <!-- Grid de Tarjetas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Último Hábito -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Último Hábito
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimoHabito)
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Tipo:</span>
                                    <span class="text-gray-900 font-semibold">{{ $ultimoHabito->tipoHabito->tipo_hab_nombre ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Detalle:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimoHabito->hab_detalle }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se han registrado hábitos.</p>
                        @endif
                    </div>
                </div>

                <!-- Último Antecedente -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Último Antecedente
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimoAntecedente)
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Tipo:</span>
                                    <span class="text-gray-900 font-semibold">{{ $ultimoAntecedente->tipoAntecedente->tipa_nombre ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Detalle:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimoAntecedente->ant_detalle }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se han registrado antecedentes.</p>
                        @endif
                    </div>
                </div>

                <!-- Última Enfermedad Actual -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            Última Enfermedad Actual
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimaEnfermedadActual)
                            <div class="space-y-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <span class="font-medium text-gray-600">Motivo:</span>
                                        <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_motivo }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Tiempo:</span>
                                        <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_tiempo }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Frecuencia:</span>
                                        <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_frecuencia }}</p>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-600">Intensidad:</span>
                                        <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_intensidad }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Localización:</span>
                                    <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_localizacion }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Observación:</span>
                                    <p class="text-gray-900">{{ $ultimaEnfermedadActual->enf_observacion }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se han registrado enfermedades actuales.</p>
                        @endif
                    </div>
                </div>

                <!-- Estado Reproductivo -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Estado Reproductivo
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimoEstadoReproductivo)
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Menarquía:</span>
                                    <span class="text-gray-900 font-semibold">{{ $ultimoEstadoReproductivo->est_menarquia }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">Menopausia:</span>
                                    <span class="text-gray-900 font-semibold">{{ $ultimoEstadoReproductivo->est_menopausia }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-600">FUM:</span>
                                    <span class="text-gray-900 font-semibold">{{ $ultimoEstadoReproductivo->est_fum }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Observaciones:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimoEstadoReproductivo->est_observacion }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se ha registrado estado reproductivo.</p>
                        @endif
                    </div>
                </div>

                <!-- Última Evaluación -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Última Evaluación
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimaEvaluacion)
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-600">Evaluación:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimaEvaluacion->eva_descripcion }}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Fecha:</span>
                                    <span class="text-gray-900 font-semibold bg-gray-100 px-3 py-1 rounded-full text-sm">
                                        {{ $ultimaEvaluacion->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se ha registrado ninguna evaluación.</p>
                        @endif
                    </div>
                </div>

                <!-- Último Plan de Tratamiento -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Último Plan de Tratamiento
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($ultimoPlanTratamiento)
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-600">Diagnóstico:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimoPlanTratamiento->pla_diagnostico }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Plan:</span>
                                    <p class="text-gray-900 mt-1">{{ $ultimoPlanTratamiento->pla_plan }}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Fecha:</span>
                                    <span class="text-gray-900 font-semibold bg-gray-100 px-3 py-1 rounded-full text-sm">
                                        {{ $ultimoPlanTratamiento->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 text-center italic">No se ha registrado ningún plan de tratamiento.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>