<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Hábitos - Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        {{-- Datos del Paciente --}}
        <div class="mb-6 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Paciente</h3>
            <p><strong>Nombre:</strong> {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}</p>
            <p><strong>Cédula:</strong> {{ $historia->paciente->pac_cedula }}</p>
        </div>

        {{-- Hábitos Registrados --}}
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h4 class="text-lg font-medium text-gray-800 mb-4">Hábitos Registrados</h4>

            @if($historia->habitos->isEmpty())
                <p class="text-gray-500">No hay hábitos registrados para esta historia clínica.</p>
            @else
                <ul class="space-y-3 text-gray-700">
                    @foreach ($historia->habitos as $habito)
                        <li class="border-b pb-2">
                            <strong>{{ $habito->tipoHabito->tipo_hab_nombre }}</strong>
                            @if ($habito->hab_detalle)
                                <div class="text-sm text-gray-600 mt-1">Detalle: {{ $habito->hab_detalle }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Botón volver --}}
        <div class="mt-6">
            <a href="{{ route('historia_clinica.index') }}"
               class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                ← Volver a la lista de historias
            </a>
        </div>
    </div>
</x-app-layout>
