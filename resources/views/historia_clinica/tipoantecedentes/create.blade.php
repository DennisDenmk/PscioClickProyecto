<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Crear Tipo de Antecedente
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('error'))
            <div class="mb-4 text-red-600 font-medium">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Vista de formulario para pantallas grandes -->
            <div class="hidden lg:block">
                <div class="p-8">
                    <form method="POST" action="{{ route('tipo_antecedente.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label value="Nombre del tipo" for="tipa_nombre" class="text-sm font-medium text-gray-500 uppercase tracking-wider" />
                            <x-text-input
                                name="tipa_nombre"
                                class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primarycolor-logo focus:border-transparent"
                                value="{{ old('tipa_nombre') }}"
                            />
                            <x-input-error :messages="$errors->get('tipa_nombre')" class="mt-1" />
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                                Guardar
                            </button>

                            <a href="{{ route('tipo_antecedente.index') }}"
                               class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista de formulario para tablets -->
            <div class="hidden md:block lg:hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('tipo_antecedente.store') }}">
                        @csrf

                        <div class="mb-6">
                            <div class="text-sm font-medium text-gray-500 mb-2">Nombre del tipo</div>
                            <x-text-input
                                name="tipa_nombre"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primarycolor-logo focus:border-transparent"
                                value="{{ old('tipa_nombre') }}"
                            />
                            <x-input-error :messages="$errors->get('tipa_nombre')" class="mt-1" />
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300 flex-1 text-center">
                                Guardar
                            </button>

                            <a href="{{ route('tipo_antecedente.index') }}"
                               class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300 flex-1 text-center">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista compacta para móviles -->
            <div class="block md:hidden">
                <div class="p-4">
                    <form method="POST" action="{{ route('tipo_antecedente.store') }}">
                        @csrf

                        <div class="mb-4">
                            <div class="text-sm font-medium text-gray-900 mb-2">Nombre del tipo</div>
                            <x-text-input
                                name="tipa_nombre"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primarycolor-logo focus:border-transparent text-sm"
                                value="{{ old('tipa_nombre') }}"
                            />
                            <x-input-error :messages="$errors->get('tipa_nombre')" class="mt-1 text-xs" />
                        </div>

                        <div class="flex flex-col gap-2">
                            <button type="submit" class="bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-3 px-4 rounded-lg shadow transition duration-300 w-full text-center">
                                Guardar
                            </button>

                            <a href="{{ route('tipo_antecedente.index') }}"
                               class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg shadow transition duration-300 w-full text-center">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
