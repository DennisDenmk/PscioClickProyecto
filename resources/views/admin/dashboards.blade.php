<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Dashboard de Administrador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.298.535 6.121 1.48M15 12a3 3 0 10-6 0 3 3 0 006 0z"/>
                    </svg>
                    Bienvenido, administrador
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    {{ Auth::user()->email }}
                </p>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Aquí puedes gestionar usuarios, roles y configuraciones generales del sistema.
                </p>
            </div>

            <!-- Paneles de Estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-100 to-purple-200 dark:from-purple-900 dark:to-purple-800">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-purple-900 dark:text-white">Citas Hoy</h4>
                        <svg class="w-6 h-6 text-purple-700 dark:text-purple-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold mt-2 text-purple-800 dark:text-purple-200">12</p>
                </div>

                <div class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900 dark:to-green-800">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-white">Pacientes Activos</h4>
                        <svg class="w-6 h-6 text-green-700 dark:text-green-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 20h5v-2a4 4 0 00-5-4m-6 6v-2a4 4 0 00-5-4H3v6h6zm0-6a4 4 0 01-5-4V4a4 4 0 018 0v6a4 4 0 01-5 4z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold mt-2 text-green-800 dark:text-green-200">85</p>
                </div>

                <div class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-yellow-100 to-yellow-200 dark:from-yellow-800 dark:to-yellow-600">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-yellow-900 dark:text-white">Ingresos del Mes</h4>
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-100" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 1.343-3 3m0 0a3 3 0 006 0m-3 6v-6m0 0V8m0 0H9m3 0h3"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold mt-2 text-yellow-700 dark:text-yellow-100">$4,250</p>
                </div>

                <div class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-blue-900 dark:text-white">Fisioterapeutas</h4>
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.298.535 6.121 1.48M15 12a3 3 0 10-6 0 3 3 0 006 0z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold mt-2 text-blue-700 dark:text-blue-200">4</p>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <a href="{{ route('register') }}"
                   class="flex items-center gap-3 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg p-6 shadow transition">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Registrar Usuario
                </a>
                <a href="{{ route('usuarios.index') }}"
                   class="flex items-center gap-3 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg p-6 shadow transition">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    Control de Usuarios
                </a>
                <a href="#"
                   class="flex items-center gap-3 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg p-6 shadow transition">
                    <svg class="w-6 h-6 text-teal-500 dark:text-teal-300" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Ver Agenda de Citas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
