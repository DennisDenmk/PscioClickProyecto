<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Registrar Historia Clínica
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <form method="POST" action="{{ route('historia_clinica.store') }}">
                @csrf

                <!-- Vista de escritorio -->
                <div class="hidden lg:block p-8">
                    <!-- Selección del Paciente -->
                    <div class="mb-6">
                        <label for="pac_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Paciente
                        </label>
                        <select id="pac_id" name="pac_id"
                            class="mt-2 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->pac_cedula }}">
                                    {{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }} - {{ $paciente->pac_cedula }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pac_id')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                            Guardar Historia Clínica
                        </button>
                    </div>
                </div>

                <!-- Vista tablet -->
                <div class="hidden md:block lg:hidden p-4">
                    <div class="bg-gray-50 rounded-lg p-4 border mb-4">
                        <div class="text-sm font-medium text-gray-500">Paciente</div>
                        <select id="pac_id" name="pac_id"
                            class="mt-2 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->pac_cedula }}">
                                    {{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }} - {{ $paciente->pac_cedula }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pac_id')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div class="flex flex-wrap gap-2 mt-3">
                        <button type="submit"
                            class="bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                            Guardar Historia Clínica
                        </button>
                    </div>
                </div>

                <!-- Vista móvil -->
                <div class="block md:hidden p-3">
                    <div class="bg-gray-50 rounded-lg p-3 border mb-3">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-500">Paciente</div>
                            </div>
                        </div>

                        <select id="pac_id" name="pac_id"
                            class="mt-2 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->pac_cedula }}">
                                    {{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }} - {{ $paciente->pac_cedula }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pac_id')" class="mt-2 text-sm text-red-500" />

                        <div class="flex flex-col sm:flex-row gap-2 mt-3">
                            <button type="submit"
                                class="bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300 text-center flex-1">
                                Guardar Historia Clínica
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
