<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard de Administrador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">Bienvenido, administrador</h3>
                <p class="mt-2 text-gray-600">
                    Aquí puedes gestionar usuarios, roles y configuraciones generales del sistema.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Registrar Usuario -->
                <a href="{{ route('register') }}"
                   class="block bg-purple-100 hover:bg-purple-200 border border-purple-400 text-purple-800 font-semibold rounded-lg p-6 shadow text-center">
                    Registrar Usuario
                </a>

                
            </div>
        </div>
    </div>
</x-app-layout>
