<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Detalles del Paciente</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }}</h3>

        <ul class="space-y-3 text-gray-700 dark:text-gray-300">
            <li><strong class="font-semibold">Cédula:</strong> {{ $paciente->pac_cedula }}</li>
            <li><strong class="font-semibold">Sexo:</strong> {{ $paciente->pac_sexo ? 'Masculino' : 'Femenino' }}</li>
            <li><strong class="font-semibold">Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($paciente->pac_fecha_nacimiento)->format('d/m/Y') }}</li>
            <li><strong class="font-semibold">Estado civil:</strong> {{ $paciente->estadoCivil->estc_nombre ?? 'N/A' }}</li>
            <li><strong class="font-semibold">Profesión:</strong> {{ $paciente->pac_profesion ?? 'N/A' }}</li>
            <li><strong class="font-semibold">Ocupación:</strong> {{ $paciente->pac_ocupacion ?? 'N/A' }}</li>
            <li><strong class="font-semibold">Teléfono:</strong> {{ $paciente->pac_telefono ?? 'N/A' }}</li>
            <li><strong class="font-semibold">Dirección:</strong> {{ $paciente->pac_direccion ?? 'N/A' }}</li>
            <li><strong class="font-semibold">Email:</strong> {{ $paciente->pac_email ?? 'N/A' }}</li>
        </ul>

        <div class="mt-8">
            @if ($paciente->historiaClinica)
                <a href="{{ route('historia_clinica.home', $paciente->historiaClinica->his_id) }}"
                   class="inline-block px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-300">
                    Ver Historia Clínica
                </a>
            @else
                <p class="text-gray-500 italic">No tiene historia clínica registrada.</p>
            @endif
        </div>
    </div>
</x-app-layout>
