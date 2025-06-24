<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Registrar Historia Clínica</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('historia_clinica.store') }}">
            @csrf

            <!-- Selección del Paciente -->
            <div class="mb-4">
                <x-input-label for="pac_id" :value="'Paciente'" />
                <select id="pac_id" name="pac_id" class="block w-full mt-1">
                    <option value="">Seleccione un paciente</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->pac_cedula }}">{{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }} - {{ $paciente->pac_cedula }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pac_id')" class="mt-2" />
            </div>

            <!-- Puedes agregar más campos aquí si tu tabla historia_clinica tiene más columnas -->

            <div class="mt-6">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                    Guardar Historia Clínica
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
