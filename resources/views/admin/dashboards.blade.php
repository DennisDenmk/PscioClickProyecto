<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Dashboard de Administrador
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
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.6), 0 0 40px rgba(99, 102, 241, 0.4); }
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
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 shadow-2xl">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-lg"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.298.535 6.121 1.48M15 12a3 3 0 10-6 0 3 3 0 006 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                Bienvenido, Administrador
                            </h3>
                            <p class="text-white/80 text-lg">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed">
                        Gestiona tu sistema de fisioterapia con herramientas avanzadas y análisis en tiempo real.
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
                                <p class="text-3xl font-black bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent">12</p>
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
                                <p class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">85</p>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Pacientes Activos</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-green-500 font-medium">+12.5%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">este mes</span>
                        </div>
                    </div>
                </div>

                <!-- Ingresos del Mes -->
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
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Ingresos del Mes</h4>
                        <div class="flex items-center text-sm">
                            <span class="text-green-500 font-medium">+18.7%</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">vs mes anterior</span>
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
                                <p class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">4</p>
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

            <!-- Acciones Rápidas Modernizadas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('register') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-indigo-50 hover:to-purple-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Registrar Usuario
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Añade nuevos usuarios al sistema con roles específicos
                        </p>

                        <div class="mt-6 flex items-center text-indigo-600 dark:text-indigo-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Crear ahora
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('usuarios.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-emerald-50 hover:to-teal-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            Control de Usuarios
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Gestiona permisos y visualiza todos los usuarios registrados
                        </p>

                        <div class="mt-6 flex items-center text-emerald-600 dark:text-emerald-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Ver usuarios
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="#"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-amber-50 hover:to-orange-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-amber-300 dark:hover:border-amber-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-orange-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Ver Agenda de Citas
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Consulta y administra todas las citas programadas
                        </p>

                        <div class="mt-6 flex items-center text-amber-600 dark:text-amber-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Ver agenda
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
