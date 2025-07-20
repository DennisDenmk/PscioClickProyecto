<section
    class="relative overflow-hidden bo-900/20 rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50">
    <!-- Efectos de fondo -->
    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 opacity-50"></div>
    <div
        class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-400/10 to-purple-600/10 rounded-full blur-3xl">
    </div>
    <div
        class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-blue-400/10 to-cyan-600/10 rounded-full blur-3xl">
    </div>

    <div class="relative z-10 p-8 lg:p-12">
        <header class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2
                        class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-indigo-600 dark:from-white dark:to-indigo-400 bg-clip-text text-transparent">
                        {{ __('Información de Perfil') }}
                    </h2>
                </div>
            </div>

            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ __('Si desea cambiar actulizar su informacion de perfil contacte con el administrador') }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <div class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Campo Nombre -->
                <div class="group">
                    <x-input-label for="name" :value="__('Name')"
                        class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors" />

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 transition-colors" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div
                            class="pl-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 text-gray-900 dark:text-white py-4 px-3">
                            {{ $user->name }}
                        </div>
                    </div>
                </div>

                <!-- Campo Apellido -->
                <div class="group">
                    <x-input-label for="apellido" :value="__('Apellido')"
                        class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors" />

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 transition-colors" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div
                            class="pl-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 text-gray-900 dark:text-white py-4 px-3">
                            {{ $user->apellido }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campo Email -->
            <div class="group">
                <x-input-label for="email" :value="__('Email')"
                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 transition-colors" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div
                        class="pl-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 text-gray-900 dark:text-white py-4 px-3">
                        {{ $user->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .group:focus-within .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 1.5s ease-out;
        }
    </style>
</section>
