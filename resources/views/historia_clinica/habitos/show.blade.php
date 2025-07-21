<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Hábitos - Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        {{-- Datos del Paciente --}}
        <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="mb-6 p-4 rounded-lg shadow-sm" style="background-color: #f8fcfa; border-left: 4px solid #2d7a6b;">
            <h3 class="text-lg font-bold mb-2" style="color: #1a5555;">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm" style="color: #2d7a6b;">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>
        </div>
        <div>
            <a href="{{ route('habitos.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md font-medium transition-colors duration-200 border-2"
                style="color: #1a5555; border-color: #7bb899; background-color: transparent;"
                onmouseover="this.style.backgroundColor='#c8e6dc'; this.style.borderColor='#2d7a6b'"
                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#7bb899'">
                Registrar Hábitos
            </a>
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
