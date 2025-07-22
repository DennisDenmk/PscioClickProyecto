<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                Dashboard de Doctor
            </h2>
            <div class="flex items-center gap-4">
                <!-- Panel de Notificaciones Modernizado -->
                @php
                    $notificacionesNoLeidas = auth()->user()->unreadNotifications;
                @endphp

                <div class="relative">
                    <button onclick="document.getElementById('notificacionesPanel').classList.toggle('hidden')"
                            class="relative p-3 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 backdrop-blur-sm border border-blue-200/50 dark:border-blue-500/30 rounded-2xl hover:from-blue-500/30 hover:to-cyan-500/30 transition-all duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.312 6.022 23.848 23.848 0 005.455 1.31m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        @if ($notificacionesNoLeidas->count())
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center animate-pulse shadow-lg">
                                {{ $notificacionesNoLeidas->count() }}
                            </span>
                        @endif
                    </button>

                    <div id="notificacionesPanel"
                        class="hidden absolute right-0 mt-4 w-96 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-2xl z-50 overflow-hidden">

                        <!-- Header del panel -->
                        <div class="p-4 bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-lg">Notificaciones</h3>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                    <span class="text-sm opacity-90">{{ $notificacionesNoLeidas->count() }} nuevas</span>
                                </div>
                            </div>
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            @forelse (auth()->user()->notifications->take(10) as $notification)
                                <a href="{{ route('citas.show', $notification->data['cita_id']) }}"
                                    class="block p-4 border-b border-gray-100 dark:border-gray-700 hover:bg-blue-50/50 dark:hover:bg-blue-900/20 transition-all duration-300 {{ $notification->read_at ? '' : 'bg-gradient-to-r from-blue-50/30 to-cyan-50/30 dark:from-blue-900/10 dark:to-cyan-900/10' }}">

                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-800 dark:text-white text-sm leading-tight">
                                                {{ $notification->data['mensaje'] }}
                                            </p>
                                            <div class="mt-2 space-y-1">
                                                <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">
                                                    📅 {{ $notification->data['fecha'] }} - {{ $notification->data['hora'] }}
                                                </p>
                                                <p class="text-xs text-gray-600 dark:text-gray-300">
                                                    👤 {{ $notification->data['paciente'] }}
                                                </p>
                                            </div>

                                            @if (!$notification->read_at)
                                                <div class="mt-3">
                                                    <form method="POST" action="{{ route('notificaciones.marcarLeida', $notification->id) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="inline-flex items-center gap-1 text-xs bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1 rounded-full hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200"
                                                                onclick="event.stopPropagation()">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Marcar leída
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                        @if (!$notification->read_at)
                                            <div class="w-3 h-3 bg-blue-500 rounded-full flex-shrink-0 mt-1"></div>
                                        @endif
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.312 6.022 23.848 23.848 0 005.455 1.31m5.714 0a3 3 0 11-5.714 0"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">No tienes notificaciones</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-300">En línea</span>
                </div>
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
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-600 rounded-2xl p-8 shadow-2xl">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-lg"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                Bienvenido, Doctor
                            </h3>
                            <p class="text-white/80 text-lg">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed">
                        Consulta tus pacientes, registra diagnósticos y accede a historias clínicas desde tu panel profesional.
                    </p>
                </div>
            </div>

            <!-- Acciones Principales Modernizadas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Ver Historias Clínicas -->
                <a href="{{ route('historia_clinica.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-indigo-50 hover:to-blue-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-500/10 to-blue-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Ver Historias Clínicas
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Accede al historial médico completo de tus pacientes
                        </p>

                        <div class="mt-6 flex items-center text-indigo-600 dark:text-indigo-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Ver todas
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Tipo Antecedentes -->
                <a href="{{ route('tipo_antecedente.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-purple-50 hover:to-violet-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-violet-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Tipo Antecedentes
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Gestiona y clasifica los antecedentes médicos
                        </p>

                        <div class="mt-6 flex items-center text-purple-600 dark:text-purple-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Gestionar tipos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Ver Calendario -->
                <a href="{{ route('citas.calendario') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-amber-50 hover:to-orange-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-amber-300 dark:hover:border-amber-600 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-orange-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Ver Calendario
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Consulta y gestiona tu agenda de citas médicas
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

            <!-- Acciones Secundarias -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Tipo Enfermedad Actual -->
                <a href="{{ route('tipo_enfermedad_actual.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-red-50 hover:to-pink-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-red-500/10 to-pink-500/10 rounded-full -translate-y-12 translate-x-12 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                Tipo Enfermedad Actual
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Clasificación de enfermedades actuales
                            </p>
                        </div>

                        <div class="text-red-600 dark:text-red-400 group-hover:translate-x-2 transition-transform duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Tipo Hábito -->
                <a href="{{ route('tipo_habito.index') }}"
                   class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-teal-50 hover:to-cyan-50 dark:hover:from-gray-700 dark:hover:to-gray-800 border border-gray-200 dark:border-gray-700 hover:border-teal-300 dark:hover:border-teal-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-teal-500/10 to-cyan-500/10 rounded-full -translate-y-12 translate-x-12 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                Tipo Hábito
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Gestión de hábitos y estilos de vida
                            </p>
                        </div>

                        <div class="text-teal-600 dark:text-teal-400 group-hover:translate-x-2 transition-transform duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
