<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Registrar Historia Clínica
        </h2>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
            <form method="POST" action="{{ route('historia_clinica.store') }}">
                @csrf

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

                <!-- Más campos aquí si es necesario -->

                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                        Guardar Historia Clínica
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
