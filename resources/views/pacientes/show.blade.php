<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Detalles del Paciente
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">{{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }}</h3>

        <ul class="space-y-2 text-gray-700">
            <li><strong>Cédula:</strong> {{ $paciente->pac_cedula }}</li>
            <li><strong>Sexo:</strong> {{ $paciente->pac_sexo ? 'Masculino' : 'Femenino' }}</li>
            <li><strong>Fecha de nacimiento:</strong> {{ $paciente->pac_fecha_nacimiento }}</li>
            <li><strong>Estado civil:</strong> {{ $paciente->estadoCivil->estc_nombre ?? 'N/A' }}</li>
            <li><strong>Profesión:</strong> {{ $paciente->pac_profesion ?? 'N/A' }}</li>
            <li><strong>Ocupación:</strong> {{ $paciente->pac_ocupacion ?? 'N/A' }}</li>
            <li><strong>Teléfono:</strong> {{ $paciente->pac_telefono ?? 'N/A' }}</li>
            <li><strong>Dirección:</strong> {{ $paciente->pac_direccion ?? 'N/A' }}</li>
            <li><strong>Email:</strong> {{ $paciente->pac_email ?? 'N/A' }}</li>
        </ul>
        <div class="mt-6">
            @if ($paciente->historiaClinica)
                <a href="{{ route('historias.show', $paciente->historiaClinica->his_id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Ver Historia Clínica
                </a>
            @else
                <span class="text-gray-500 italic">No tiene historia clínica registrada.</span>
            @endif
        </div>
    </div>
</x-app-layout>
