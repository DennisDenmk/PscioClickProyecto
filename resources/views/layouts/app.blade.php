<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-[#0F172A]">
            <x-notification />
            @livewire('navigation')

            <!-- Page Content - Ajustado para ser responsive con la sidebar -->
            <main class="ml-12 md:ml-12 transition-all duration-500 ease-in-out pt-20 px-2 md:px-5 pb-4" id="main-content">
                <div class="max-w-full">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Script para sincronizar el contenido principal con la sidebar -->
        <script>
            // Función para ajustar el contenido principal cuando cambia la sidebar
            function adjustMainContent() {
                const sidebar = document.querySelector("aside");
                const mainContent = document.getElementById("main-content");

                if (sidebar && mainContent) {
                    // Observer para detectar cambios en las clases de la sidebar
                    const observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                                updateMainContentMargin();
                            }
                        });
                    });

                    // Configurar el observer
                    observer.observe(sidebar, {
                        attributes: true,
                        attributeFilter: ['class']
                    });

                    // Función para actualizar el margen del contenido principal
                    function updateMainContentMargin() {
                        if (sidebar.classList.contains('-translate-x-48')) {
                            // Sidebar cerrada - solo margen pequeño
                            mainContent.className = mainContent.className.replace(/ml-\d+/g, '');
                            mainContent.classList.add('ml-12');
                        } else {
                            // Sidebar abierta - margen mayor en pantallas medianas y grandes
                            mainContent.className = mainContent.className.replace(/ml-\d+/g, '');
                            mainContent.classList.add('ml-12', 'md:ml-60');
                        }
                    }

                    // Ejecutar una vez al cargar
                    updateMainContentMargin();
                }
            }

            // Ejecutar cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', adjustMainContent);

            // También ejecutar después de que Livewire se haya inicializado
            document.addEventListener('livewire:load', adjustMainContent);
        </script>

    </body>
</html>
