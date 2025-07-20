<section class="relative overflow-hidden bg-gradient-to-br from-white via-slate-50 to-red-50 dark:from-gray-900 dark:via-gray-800 dark:to-red-900/20 rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50">
    <!-- Efectos de fondo -->
    <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 via-pink-500/5 to-rose-500/5 opacity-50"></div>
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-red-400/10 to-pink-600/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-rose-400/10 to-red-600/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 p-8 lg:p-12">
        <header class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-red-600 dark:from-white dark:to-red-400 bg-clip-text text-transparent">
                        {{ __('Actualizar Contraseña') }}
                    </h2>
                </div>
            </div>

            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ __('Asegurese de crear una contraseña segura y no olvidarla') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-8">
            @csrf
            @method('put')

            <!-- Campo Contraseña Actual -->
            <div class="group">
                <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')"
                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors group-focus-within:text-red-600 dark:group-focus-within:text-red-400" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <button type="button" onclick="togglePassword('update_password_current_password')" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" id="eye-update_password_current_password">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M18.36 5.64l-2.829 2.829m-2.828 2.829L9.878 9.878"/>
                            </svg>
                        </button>
                    </div>
                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                        class="pl-12 pr-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:shadow-xl transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                        autocomplete="current-password"
                        placeholder="Contraseña actual" />
                </div>
                <x-input-error class="mt-2 text-red-500 text-sm font-medium" :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <!-- Campo Nueva Contraseña -->
            <div class="group">
                <x-input-label for="update_password_password" :value="__('Nueva Contraseña')"
                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors group-focus-within:text-red-600 dark:group-focus-within:text-red-400" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <button type="button" onclick="togglePassword('update_password_password')" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" id="eye-update_password_password">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M18.36 5.64l-2.829 2.829m-2.828 2.829L9.878 9.878"/>
                            </svg>
                        </button>
                    </div>
                    <x-text-input id="update_password_password" name="password" type="password"
                        class="pl-12 pr-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:shadow-xl transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                        autocomplete="new-password"
                        placeholder="Nueva contraseña" />
                </div>
                <x-input-error class="mt-2 text-red-500 text-sm font-medium" :messages="$errors->updatePassword->get('password')" />

                <!-- Indicador de fuerza de contraseña -->
                <div class="mt-3 space-y-2">
                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <span>Fuerza de contraseña:</span>
                        <div class="flex gap-1">
                            <div class="w-6 h-1 bg-gray-200 dark:bg-gray-600 rounded-full" id="strength-1"></div>
                            <div class="w-6 h-1 bg-gray-200 dark:bg-gray-600 rounded-full" id="strength-2"></div>
                            <div class="w-6 h-1 bg-gray-200 dark:bg-gray-600 rounded-full" id="strength-3"></div>
                            <div class="w-6 h-1 bg-gray-200 dark:bg-gray-600 rounded-full" id="strength-4"></div>
                        </div>
                        <span id="strength-text">Débil</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Use al menos 8 caracteres con una combinación de letras, números y símbolos
                    </p>
                </div>
            </div>

            <!-- Campo Confirmar Contraseña -->
            <div class="group">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')"
                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2 block transition-colors group-focus-within:text-red-600 dark:group-focus-within:text-red-400" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <button type="button" onclick="togglePassword('update_password_password_confirmation')" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" id="eye-update_password_password_confirmation">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M18.36 5.64l-2.829 2.829m-2.828 2.829L9.878 9.878"/>
                            </svg>
                        </button>
                    </div>
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        class="pl-12 pr-12 block w-full h-14 rounded-2xl border-0 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:shadow-xl transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                        autocomplete="new-password"
                        placeholder="Confirmar contraseña" />
                </div>
                <x-input-error class="mt-2 text-red-500 text-sm font-medium" :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <x-primary-button class="relative overflow-hidden bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:ring-4 focus:ring-red-500/25">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            {{ __('Save') }}
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </x-primary-button>

                    @if (session('status') === 'password-updated')
                        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            x-init="setTimeout(() => show = false, 4000)"
                            class="flex items-center gap-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 px-4 py-2 rounded-xl border border-green-200 dark:border-green-800">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ __('Saved.') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Información adicional -->
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.414-4.414a2 2 0 00-2.828 0L4 16.172V20h3.828l10.586-10.586a2 2 0 000-2.828z"/>
                    </svg>
                    <span>Actualización segura de contraseña</span>
                </div>
            </div>
        </form>
    </div>

    <style>
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .group:focus-within .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 1.5s ease-out;
        }

        .strength-weak { background-color: #ef4444; }
        .strength-fair { background-color: #f59e0b; }
        .strength-good { background-color: #3b82f6; }
        .strength-strong { background-color: #10b981; }
    </style>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById('eye-' + fieldId);

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M18.36 5.64l-2.829 2.829m-2.828 2.829L9.878 9.878"/>';
            }
        }

        // Verificador de fuerza de contraseña
        document.getElementById('update_password_password').addEventListener('input', function(e) {
            const password = e.target.value;
            let strength = 0;
            const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
            const strengthText = document.getElementById('strength-text');

            // Resetear indicadores
            indicators.forEach(id => {
                const el = document.getElementById(id);
                el.className = 'w-6 h-1 bg-gray-200 dark:bg-gray-600 rounded-full';
            });

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            let strengthLevel = Math.min(Math.floor(strength * 4 / 5), 4);
            let strengthClass = '';
            let strengthLabel = '';

            switch(strengthLevel) {
                case 1:
                    strengthClass = 'strength-weak';
                    strengthLabel = 'Débil';
                    break;
                case 2:
                    strengthClass = 'strength-fair';
                    strengthLabel = 'Regular';
                    break;
                case 3:
                    strengthClass = 'strength-good';
                    strengthLabel = 'Buena';
                    break;
                case 4:
                    strengthClass = 'strength-strong';
                    strengthLabel = 'Fuerte';
                    break;
                default:
                    strengthLabel = 'Muy débil';
            }

            for (let i = 0; i < strengthLevel; i++) {
                document.getElementById(indicators[i]).className = `w-6 h-1 ${strengthClass} rounded-full`;
            }

            strengthText.textContent = strengthLabel;
        });
    </script>
</section>
