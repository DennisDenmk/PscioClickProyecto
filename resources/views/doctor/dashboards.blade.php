<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Dashboard de Doctor
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">Bienvenido, doctor</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Consulta tus pacientes, registra diagnósticos y accede a historias clínicas desde aquí.
                </p>
            </div>

            <!-- Acciones estilo administrador -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Registrar Historia Clínica -->
                <a href="{{ route('historia_clinica.create') }}"
                   class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-100 to-blue-300 dark:from-blue-900 dark:to-blue-800 hover:shadow-lg transition duration-300 block">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-blue-900 dark:text-white">Registrar Historia</h4>
                        <svg class="w-6 h-6 text-blue-700 dark:text-blue-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <p class="text-md font-bold mt-3 text-blue-800 dark:text-blue-200">➤ Ingresar ahora</p>
                </a>

                <!-- Ver Historias Clínicas -->
                <a href="{{ route('historia_clinica.index') }}"
                   class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-100 to-indigo-300 dark:from-indigo-900 dark:to-indigo-800 hover:shadow-lg transition duration-300 block">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-indigo-900 dark:text-white">Ver Historias</h4>
                        <svg class="w-6 h-6 text-indigo-700 dark:text-indigo-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m0 0V8m0 4v4"/>
                        </svg>
                    </div>
                    <p class="text-md font-bold mt-3 text-indigo-800 dark:text-indigo-200">➤ Ver todas</p>
                </a>

                <!-- Tipo Antecedentes -->
                <a href="{{ route('tipo_antecedente.index') }}"
                   class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-100 to-purple-300 dark:from-purple-900 dark:to-purple-800 hover:shadow-lg transition duration-300 block">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-purple-900 dark:text-white">Tipo Antecedentes</h4>
                        <svg class="w-6 h-6 text-purple-700 dark:text-purple-200" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-md font-bold mt-3 text-purple-800 dark:text-purple-200">➤ Gestionar tipos</p>
                </a>

                <!-- Ver Calendario -->
                <a href="{{ route('citas.calendario') }}"
                   class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-yellow-100 to-yellow-200 dark:from-yellow-800 dark:to-yellow-600 hover:shadow-lg transition duration-300 block">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-semibold text-yellow-900 dark:text-white">Calendario</h4>
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-100" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-md font-bold mt-3 text-yellow-700 dark:text-yellow-100">➤ Ver agenda</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
