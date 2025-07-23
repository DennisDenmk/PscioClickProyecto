<x-app-layout>
<div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300 mt-6">
    <!-- Header con gradiente -->
    <div class="bg-gradient-to-r from-emerald-700 to-emerald-600 px-6 py-4">
        <div class="flex items-center justify-between">
            <h4 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                </svg>
                Enfermedades Actuales
            </h4>
            
            <!-- Botón para añadir enfermedad mejorado -->
            <a href="{{route('enfermedad_actual.create', $historia->his_id)}}" 
               class="inline-flex items-center px-4 py-2 bg-white text-emerald-700 text-sm font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-800 transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Enfermedad
            </a>
        </div>
    </div>
    
    <!-- Contenido -->
    <div class="p-6">
        @if($historia->enfermedadesActuales->isEmpty())
            <!-- Estado vacío con diseño mejorado -->
            <div class="text-center py-8">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500 text-lg">No hay enfermedades actuales registradas</p>
                <p class="text-gray-400 text-sm mt-2">Los registros de enfermedades aparecerán aquí una vez que sean agregados</p>
                
                <!-- Botón CTA en estado vacío -->
                <div class="mt-6">
                    <a href="{{route('enfermedad_actual.create', $historia->his_id)}}" 
                       class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Primera Enfermedad
                    </a>
                </div>
            </div>
        @else
            <!-- Lista de enfermedades con diseño mejorado -->
            <div class="space-y-4">
                @foreach ($historia->enfermedadesActuales as $index => $enf)
                    <div class="group relative bg-gradient-to-r from-gray-50 to-emerald-50 rounded-lg p-4 border border-gray-200 hover:border-emerald-300 transition-all duration-200 hover:shadow-md">
                        <!-- Indicador numérico -->
                        <div class="absolute -left-2 -top-2 w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
                            {{ $index + 1 }}
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="absolute top-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <!-- Botón Editar -->
                            <!--<a href="{{ route('enfermedad_actual.edit', [$historia->his_id, $enf->enf_id]) }}"
                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 hover:text-blue-700 transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                            title="Editar enfermedad">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            -->
                            
                            <!-- Botón Eliminar -->
                            <form action="{{ route('enfermedad_actual.destroy', ['his_id' => $historia->his_id, 'id' => $enf->enf_id]) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta enfermedad? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 hover:text-red-700 transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="Eliminar enfermedad">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>

                        </div>
                        
                        <!-- Contenido principal -->
                        <div class="ml-4 pr-20">
                            <!-- Título de la enfermedad -->
                            <div class="flex items-start justify-between mb-3">
                                <h5 class="text-lg font-semibold text-slate-800 group-hover:text-emerald-700 transition-colors duration-200">
                                    {{ $enf->tipoEnfermedad->tipo_enf_nombre }}
                                </h5>
                                <!-- Badge de estado -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="3"></circle>
                                    </svg>
                                    Activa
                                </span>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="bg-white rounded-md p-3 border border-gray-100">
                                <div class="flex items-start space-x-2">
                                    <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Descripción:</span>
                                        <p class="text-gray-800 mt-1 leading-relaxed">{{ $enf->enf_descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Información adicional si existe -->
                            @if(isset($enf->enf_fecha) || isset($enf->created_at))
                                <div class="mt-3 flex items-center text-xs text-gray-500">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Registrado: {{ $enf->created_at ? $enf->created_at->format('d/m/Y H:i') : 'Fecha no disponible' }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Resumen al final -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">
                        Total de enfermedades registradas:
                    </span>
                    <span class="font-semibold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                        {{ $historia->enfermedadesActuales->count() }}
                    </span>
                </div>
            </div>
            
            <!-- Botón adicional para añadir más enfermedades -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="text-center">
                    <a href="{{route('enfermedad_actual.create', $historia->his_id)}}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-medium rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Otra Enfermedad
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>