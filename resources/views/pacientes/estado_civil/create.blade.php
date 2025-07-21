<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Nuevo Estado Civil
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Botón de regreso -->
        <div class="mb-6">
            <a href="{{ route('estado_civil.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Estados Civiles
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="text-red-600 font-medium mb-2">Por favor corrige los siguientes errores:</div>
                <ul class="text-red-600 text-sm list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Vista completa para pantallas grandes y medianas -->
            <div class="hidden md:block">
                <div class="px-8 py-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Información del Estado Civil</h3>

                    <form method="POST" action="{{ route('estado_civil.store') }}" class="space-y-6">
                        @csrf

                        <div class="max-w-md">
                            <label for="estc_nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Estado Civil
                            </label>
                            <input type="text"
                                   name="estc_nombre"
                                   id="estc_nombre"
                                   value="{{ old('estc_nombre') }}"
                                   placeholder="Ej: Soltero, Casado, Divorciado..."
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200 @error('estc_nombre') border-red-500 @enderror"
                                   required>
                            @error('estc_nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="{{ route('estado_civil.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200">
                                Guardar Estado Civil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista compacta para móviles -->
            <div class="block md:hidden">
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Nuevo Estado Civil</h3>

                    <form method="POST" action="{{ route('estado_civil.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="estc_nombre_mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre
                            </label>
                            <input type="text"
                                   name="estc_nombre"
                                   id="estc_nombre_mobile"
                                   value="{{ old('estc_nombre') }}"
                                   placeholder="Nombre del estado civil"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('estc_nombre') border-red-500 @enderror"
                                   required>
                            @error('estc_nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3 pt-4">
                            <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                                Guardar Estado Civil
                            </button>
                            <a href="{{ route('estado_civil.index') }}"
                                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg text-center transition duration-200">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
