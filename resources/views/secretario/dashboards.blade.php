<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                Dashboard de Secretario
            </h2>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-sm text-gray-600 dark:text-gray-300">En línea</span>
            </div>
        </div>
    </x-slot>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.6), 0 0 40px rgba(16, 185, 129, 0.4); }
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Bienvenida Moderna -->
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 rounded-2xl p-8 shadow-2xl">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-lg"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                Bienvenido, Secretario
                            </h3>
                            <p class="text-white/80 text-lg">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed">
                        Gestiona pacientes, citas y mantén organizada la agenda de la clínica de fisioterapia.
                    </p>
                </div>
            </div>

            <!-- Paneles de Estadísticas Modernizados -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Citas Hoy -->
                <div class="card-hover group relative bg-gradient-to-br from-violet-500/10 via-purple-500/10 to-violet-600/10 dark:from-violet-500/20 dark:via-purple-500/20 dark:to-violet-600/20 backdrop-blur-sm border border-violet-200/50 dark:border-violet-500/30 rounded-2xl p-6 shadow-lg hover:shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-500/5 to-purple-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:animate-pulse">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent"></p>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Citas Hoy</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-green-500 font-medium">+8.2%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">vs ayer</span>
                        </div>
                    </div>
                </div>

                <!-- Pacientes Activos -->
                <div class="card-hover group relative bg-gradient-to-br from-emerald-500/10 via-teal-500/10 to-green-600/10 dark:from-emerald-500/20 dark:via-teal-500/20 dark:to-green-600/20 backdrop-blur-sm border border-emerald-200/50 dark:border-emerald-500/30 rounded-2xl p-6 shadow-lg hover:shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-green-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:animate-pulse">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-4m-6 6v-2a4 4 0 00-5-4H3v6h6zm0-6a4 4 0 01-5-4V4a4 4 0 018 0v6a4 4 0 01-5 4z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent"></p>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Pacientes Registrados</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-green-500 font-medium">+12.5%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">este mes</span>
                        </div>
                    </div>
                </div>

                <!-- Personal DIsponible -->
                <div class="card-hover group relative bg-gradient-to-br from-amber-500/10 via-orange-500/10 to-yellow-600/10 dark:from-amber-500/20 dark:via-orange-500/20 dark:to-yellow-600/20 backdrop-blur-sm border border-amber-200/50 dark:border-amber-500/30 rounded-2xl p-6 shadow-lg hover:shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-yellow-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:animate-pulse">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6 4.03-6 9-6 9 4.8 9 6z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">$4,250</p>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Personal Disponible</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-green-500 font-medium">100%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">disponibles</span>
                        </div>
                    </div>
                </div>

                <!-- Fisioterapeutas -->
                <div class="card-hover group relative bg-gradient-to-br from-blue-500/10 via-cyan-500/10 to-blue-600/10 dark:from-blue-500/20 dark:via-cyan-500/20 dark:to-blue-600/20 backdrop-blur-sm border border-blue-200/50 dark:border-blue-500/30 rounded-2xl p-6 shadow-lg hover:shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-cyan-600/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg group-hover:animate-pulse">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.298.535 6.121 1.48M15 12a3 3 0 10-6 0 3 3 0 006 0z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent"></p>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fisioterapeutas</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-blue-500 font-medium">100%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">disponibles</span>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Acciones Principales Modernizadas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('pacientes.create') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-purple-50 hover:to-violet-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-violet-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Registrar Paciente
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Añade nuevos pacientes al sistema con toda su información médica
                        </p>

                        <div class="mt-6 flex items-center text-purple-600 dark:text-purple-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Crear ahora
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('pacientes.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-emerald-50 hover:to-teal-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-3-3m-5-4a4 4 0 11-8 0 4 4 0 018 0zm-5 7v2a3 3 0 01-3 3H5a3 3 0 01-3-3v-2"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Ver Pacientes
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Consulta el directorio completo de todos los pacientes registrados
                        </p>

                        <div class="mt-6 flex items-center text-emerald-600 dark:text-emerald-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Ver listado
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('citas.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-amber-50 hover:to-yellow-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-amber-300 dark:hover:border-amber-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-yellow-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Agendar Cita
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Programa nuevas citas y gestiona la agenda de los fisioterapeutas
                        </p>

                        <div class="mt-6 flex items-center text-amber-600 dark:text-amber-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Agendar
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Leyenda de Estados Modernizada -->
            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Leyenda de Estados
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800">
                        <div class="w-4 h-4 bg-amber-500 rounded-full shadow-lg"></div>
                        <span class="font-medium text-amber-800 dark:text-amber-200">Pendiente</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <div class="w-4 h-4 bg-blue-500 rounded-full shadow-lg"></div>
                        <span class="font-medium text-blue-800 dark:text-blue-200">Confirmada</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                        <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg"></div>
                        <span class="font-medium text-green-800 dark:text-green-200">Completada</span>
                    </div>
                </div>
            </div>

            <!-- Calendario -->
            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Agenda de Citas</h3>
                            <p class="text-white/80">Visualiza todas las citas programadas</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <x-calendar route="citas.calendario" />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
