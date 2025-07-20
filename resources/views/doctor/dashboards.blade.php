<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Dashboard de Doctor
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        @php
            $notificacionesNoLeidas = auth()->user()->unreadNotifications;
        @endphp

        <div class="relative text-white hover:text-blue-500 dark:hover:text-[#38BDF8]">
            <button onclick="document.getElementById('notificacionesPanel').classList.toggle('hidden')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.312 6.022 23.848 23.848 0 005.455 1.31m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                @if ($notificacionesNoLeidas->count())
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full px-1">
                        {{ $notificacionesNoLeidas->count() }}
                    </span>
                @endif
            </button>

            <div id="notificacionesPanel"
                class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow-lg z-50">
                <div class="p-2 text-sm font-semibold text-gray-700 dark:text-white border-b dark:border-gray-600">
                    Notificaciones
                </div>

                @forelse (auth()->user()->notifications as $notification)
                    <a href="{{ route('citas.show', $notification->data['cita_id']) }}"
                        class="block p-3 border-b text-sm {{ $notification->read_at ? 'bg-white' : 'bg-blue-50 dark:bg-blue-900/20' }}">
                        <p class="font-medium text-gray-800 dark:text-white">
                            {{ $notification->data['mensaje'] }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-300">
                            {{ $notification->data['fecha'] }} - {{ $notification->data['hora'] }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-300">
                            Paciente: {{ $notification->data['paciente'] }}
                        </p>
                        <div class="flex justify-between items-center mt-1">
                            @if (!$notification->read_at)
                                <form method="POST"
                                    action="{{ route('notificaciones.marcarLeida', $notification->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 text-xs hover:text-green-600"
                                        onclick="event.stopPropagation()">Marcar como leída</button>
                                </form>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="p-3 text-gray-500 text-sm text-center">No tienes notificaciones</div>
                @endforelse
            </div>
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
                        <!-- Ver Historias Clínicas -->
                        <a href="{{ route('historia_clinica.index') }}"
                            class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-100 to-indigo-300 dark:from-indigo-900 dark:to-indigo-800 hover:shadow-lg transition duration-300 block">
                            <div class="flex items-center justify-between">
                                <h4 class="text-lg font-semibold text-indigo-900 dark:text-white">Ver Historias</h4>
                                <svg class="w-6 h-6 text-indigo-700 dark:text-indigo-200" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m0 0V8m0 4v4" />
                                </svg>
                            </div>
                            <p class="text-md font-bold mt-3 text-indigo-800 dark:text-indigo-200">➤ Ver todas</p>
                        </a>

                        <!-- Tipo Antecedentes -->
                        <a href="{{ route('tipo_antecedente.index') }}"
                            class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-100 to-purple-300 dark:from-purple-900 dark:to-purple-800 hover:shadow-lg transition duration-300 block">
                            <div class="flex items-center justify-between">
                                <h4 class="text-lg font-semibold text-purple-900 dark:text-white">Tipo Antecedentes</h4>
                                <svg class="w-6 h-6 text-purple-700 dark:text-purple-200" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-md font-bold mt-3 text-purple-800 dark:text-purple-200">➤ Gestionar tipos</p>
                        </a>

                        <!-- Ver Calendario -->
                        <a href="{{ route('citas.calendario') }}"
                            class="rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700 bg-gradient-to-r from-yellow-100 to-yellow-200 dark:from-yellow-800 dark:to-yellow-600 hover:shadow-lg transition duration-300 block">
                            <div class="flex items-center justify-between">
                                <h4 class="text-lg font-semibold text-yellow-900 dark:text-white">Calendario</h4>
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-100" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-md font-bold mt-3 text-yellow-700 dark:text-yellow-100">➤ Ver agenda</p>
                        </a>
                    </div>
                </div>
            </div>
</x-app-layout>
