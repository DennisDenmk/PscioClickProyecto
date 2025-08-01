<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/alpinejs" defer></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            // Tus colores existentes...
                            'primary': '#2d6a4f',
                            'primary-dark': '#1b5e20',
                            // etc...

                            // AGREGAR estos nuevos colores para modo suave:
                            'soft-dark-bg': 'rgba(15, 23, 42, 0.7)',
                            'soft-dark-surface': 'rgba(15, 23, 42, 0.85)',
                            'soft-dark-sidebar': 'rgba(11, 93, 99, 0.9)',
                        }
                    }
                },
                theme: {
                    extend: {
                        colors: {
                            'primary': '#2d6a4f',
                            'primary-dark': '#1b5e20',
                            'primary-light': '#4caf50',
                            'teal': '#0f4c75',
                            'teal-dark': '#0d3a5f',
                            'green-light': '#81c784',
                            'accent': '#00d4aa',
                            'accent-pink': '#ff6b9d',
                            'primarycolor-logo': '#0b5d63' // <- color del logo agregado aquí
                        }
                    }
                }
            }
        </script>
        <script>
            // Inicializar tema inmediatamente para evitar flash
            (function() {
                const savedTheme = localStorage.getItem('theme');

                if (!savedTheme) {
                    // Siempre inicia en modo claro
                    document.documentElement.classList.remove('dark');
                } else if (savedTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>



<body class="body bg-white dark:bg-gray-900/70">
        <div class="fixed w-full z-30 flex bg-white dark:bg-[#0F172A] p-2 items-center justify-center h-16 px-10">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2 ml-12">

                <div class="shrink-0">
                    <x-application-logo class="h-10 w-10 rounded-full border border-primary p-1 shadow-md" />
                </div>

                <div class="leading-tight">
                    <h1 class="text-1xl font-extrabold text-primarycolor-logo">DayJu Life</h1>
                    <p class="text-xs text-gray-500 font-medium group-hover:text-primary transition duration-300">Salud
                        en Movimiento</p>
                </div>

            </x-nav-link>


            <!-- SPACER -->
            <div class="grow h-full flex items-center justify-center"></div>
            <!-- User Dropdown Menu -->

            <div class="flex-none h-full text-center flex items-center justify-center relative" x-data="{ open: false }">
                <!-- User Profile Button -->
                <button @click="open = ! open"
                    class="flex space-x-3 items-center px-3 py-2 rounded-md transition duration-150 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-700">

                    <div class="hidden md:block text-sm md:text-md text-black dark:text-white">{{ Auth::user()->name }}
                    </div>
                    <!-- Dropdown Arrow -->
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300" :class="{ 'rotate-180': open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false"
                    class="absolute right-0 top-full mt-2 w-64 bg-white dark:bg-primarycolor-logo rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50">



                    <!-- User Info Section -->
                    <div class="pt-4 pb-1 border-b border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}
                            </div>
                        </div>
                    </div>

                    <!-- Menu Options -->
                    <div class="py-1">
                        <x-responsive-nav-link :href="route('profile.edit')"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            {{ __('Perfil') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                                {{ __('Cerrar sesión') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <aside
            class="w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen bg-primarycolor-logo ">
            <!-- open sidebar button -->
            <div
                class="max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-primarycolor-logo  absolute top-2 rounded-full h-12">

                <div class="flex pl-4 items-center space-x-2 ">
                    <div>
                        <div onclick="setDark('dark')"
                            class="moon cursor-pointer text-white hover:text-blue-500 dark:hover:text-[#38BDF8]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                                stroke="currentColor" class="w-4 h-4">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                        </div>
                        <div onclick="setDark('light')"
                            class="sun cursor-pointer hidden text-white hover:text-blue-500 dark:hover:text-[#38BDF8]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-white hover:text-blue-500 dark:hover:text-[#38BDF8]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                            stroke="currentColor" class="w-4 h-4">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                </div>
                <div
                    class="flex items-center space-x-3 group bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-purple-500  pl-10 pr-2 py-1 rounded-full text-white  ">
                    <div class="transform ease-in-out duration-300 mr-12">
                        DayJu LIfe
                    </div>
                </div>
            </div>
            <div onclick="openNav()"
                class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] bg-primarycolor-logo dark:hover:bg-blue-500 hover:bg-purple-500 absolute top-2 p-3 rounded-full text-white hover:rotate-45">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <!-- MAX SIDEBAR-->
            <div class="max hidden text-white mt-20 flex-col space-y-2 w-full h-[calc(100vh)]">
                <div
                    class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-inejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <!-- Navigation Links -->
                    <div>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-inherit text-lg font-normal p-0 hover:underline">
                            Home
                        </x-nav-link>
                    </div>
                </div>
                <div
                    class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <div>
                        <a href="{{ route('profile.edit') }}"
                            class="text-inherit text-sm font-normal p-0 hover:underline">
                            {{ __('Ajustes') }}
                        </a>
                    </div>
                </div>

                @rol('administrador')
                    <div
                        class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>
                        <div>
                            <a href="{{ route('usuarios.index') }}"
                                class="text-inherit text-sm font-normal p-0 hover:underline">
                                Gestionar Empleados
                            </a>
                        </div>
                    </div>
                @endrol

                @rol('secretario')
                    <div x-data="{ open: false }" class="w-full">
                        <!-- Botón principal -->
                        <div @click="open = !open"
                            class="cursor-pointer hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex items-center space-x-3">
                            <!-- Icono -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>

                            <!-- Título -->
                            <span class="text-sm font-normal">Gestión Citas</span>
                        </div>

                        <!-- Submenú desplegable -->
                        <div x-show="open" x-transition class="mt-2 ml-12 flex flex-col space-y-1 text-sm text-white">
                            <a href="{{ route('citas.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Agendar Cita
                            </a>
                            <a href="{{ route('tipocita.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Tipo de Cita
                            </a>
                            <a href="{{ route('promociones.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Promociones
                            </a>
                            <a href="{{ route('promocioncita.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Promociones-Citas
                            </a>
                            <a href="{{ route('citas.calendario') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Calendario
                            </a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="w-full">

                        <!-- Botón principal -->
                        <div @click="open = !open"
                            class="cursor-pointer hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex items-center space-x-3">
                            <!-- Icono -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>

                            <!-- Título -->
                            <span class="text-sm font-normal">Gestión Pacientes</span>
                        </div>

                        <!-- Submenú desplegable -->
                        <div x-show="open" x-transition class="mt-2 ml-12 flex flex-col space-y-1 text-sm text-white">
                            <a href="{{ route('pacientes.create') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Registrar Paciente
                            </a>
                            <a href="{{ route('pacientes.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Ver Pacientes
                            </a>
                            <a href="{{ route('estado_civil.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Estado Civil
                            </a>
                        </div>
                    </div>
                @endrol
                @rol('doctor')
                    <div
                        class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>

                        <div>
                            <a href="{{ route('citas.calendario') }}"
                                class="text-inherit text-sm font-normal p-0 hover:underline">
                                {{ __('Calendario') }}
                            </a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="w-full">
                        <!-- Botón principal -->
                        <div @click="open = !open"
                            class="cursor-pointer hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-primarycolor-logo p-2 pl-8 rounded-full transform ease-in-out duration-300 flex items-center space-x-3">
                            <!-- Icono -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 20.25c4.97 0 9-4.03 9-9s-4.03-9-9-9-9 4.03-9 9 4.03 9 9 9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6" />
                            </svg>

                            <!-- Título -->
                            <span class="text-sm font-normal">Historia Clínica</span>
                        </div>

                        <!-- Submenú desplegable -->
                        <div x-show="open" x-transition class="mt-2 ml-12 flex flex-col space-y-1 text-sm text-white">
                            <a href="{{ route('historia_clinica.create') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Registrar Historia Clínica
                            </a>
                            <a href="{{ route('historia_clinica.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Ver Historias Clínicas
                            </a>
                            <a href="{{ route('tipo_antecedente.index') }}"
                                class="hover:text-purple-400 dark:hover:text-blue-400 transition ease-in-out duration-200">
                                ➤ Tipo Antecedentes
                            </a>
                        </div>
                    </div>
                @endrol

            </div>
            <!-- MINI SIDEBAR-->
            <div class="mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                </x-nav-link>
                <div
                    class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                    <a href="{{ route('profile.edit') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>
                </div>

                @rol('administrador')
                    <div
                        class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                        <a href="{{ route('usuarios.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                        </a>
                    </div>
                @endrol
                @rol('secretario')
                    <div
                        class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                        <a href="{{ route('citas.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>

                        </a>
                    </div>

                    <div
                        class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                        <a href="{{ route('pacientes.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                        </a>
                    </div>
                @endrol

                @rol('doctor')
                    <div
                        class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                        <a href="{{ route('citas.calendario') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>


                        </a>
                    </div>

                    <div
                        class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-primarycolor-logo p-3 rounded-full transform ease-in-out duration-300 flex">
                        <a href="{{ route('historia_clinica.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 20.25c4.97 0 9-4.03 9-9s-4.03-9-9-9-9 4.03-9 9 4.03 9 9 9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6" />
                            </svg>


                        </a>
                    </div>
                @endrol

            </div>

        </aside>
        <!-- CONTENT -->
        <script>
            const sidebar = document.querySelector("aside");
            const maxSidebar = document.querySelector(".max")
            const miniSidebar = document.querySelector(".mini")
            const roundout = document.querySelector(".roundout")
            const maxToolbar = document.querySelector(".max-toolbar")
            const logo = document.querySelector('.logo')
            const content = document.querySelector('.content')
            const moon = document.querySelector(".moon")
            const sun = document.querySelector(".sun")


            function openNav() {
                if (sidebar.classList.contains('-translate-x-48')) {
                    // max sidebar
                    sidebar.classList.remove("-translate-x-48")
                    sidebar.classList.add("translate-x-none")
                    maxSidebar.classList.remove("hidden")
                    maxSidebar.classList.add("flex")
                    miniSidebar.classList.remove("flex")
                    miniSidebar.classList.add("hidden")
                    maxToolbar.classList.add("translate-x-0")
                    maxToolbar.classList.remove("translate-x-24", "scale-x-0")

                    content.classList.remove("ml-12")
                    content.classList.add("ml-12", "md:ml-60")
                } else {
                    // mini sidebar
                    sidebar.classList.add("-translate-x-48")
                    sidebar.classList.remove("translate-x-none")
                    maxSidebar.classList.add("hidden")
                    maxSidebar.classList.remove("flex")
                    miniSidebar.classList.add("flex")
                    miniSidebar.classList.remove("hidden")
                    maxToolbar.classList.add("translate-x-24", "scale-x-0")
                    maxToolbar.classList.remove("translate-x-0")

                    content.classList.remove("ml-12", "md:ml-60")
                    content.classList.add("ml-12")

                }

            }

            function setDark(val) {
                if (val === "dark") {
                    document.documentElement.classList.add('dark')
                    localStorage.setItem('theme', 'dark')
                    moon.classList.add("hidden")
                    sun.classList.remove("hidden")
                } else {
                    document.documentElement.classList.remove('dark')
                    localStorage.setItem('theme', 'light')
                    sun.classList.add("hidden")
                    moon.classList.remove("hidden")
                }
                updateToggleVisibility(); // Actualizar visibilidad de botones
            }

            // Función para actualizar la visibilidad de los botones
            function updateToggleVisibility() {
                const isDark = document.documentElement.classList.contains('dark');
                if (isDark) {
                    moon.classList.add("hidden")
                    sun.classList.remove("hidden")
                } else {
                    sun.classList.add("hidden")
                    moon.classList.remove("hidden")
                }
            }

            // Inicializar visibilidad de botones cuando la página cargue
            document.addEventListener('DOMContentLoaded', function() {
                updateToggleVisibility();
            });
        </script>

    </body>

    </html>
</div>
