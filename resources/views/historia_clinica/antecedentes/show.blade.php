<x-app-layout>
<div class="bg-white shadow rounded p-6 mt-6">
    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="mb-6 p-4 rounded-lg shadow-sm" style="background-color: #f8fcfa; border-left: 4px solid #2d7a6b;">
            <h3 class="text-lg font-bold mb-2" style="color: #1a5555;">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm" style="color: #2d7a6b;">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>
    </div>
    <h4 class="text-lg font-medium text-gray-800 mb-4">Antecedentes Registrados</h4>

            <a href="{{ route('antecedentes.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md font-medium transition-colors duration-200 border-2"
                style="color: #1a5555; border-color: #7bb899; background-color: transparent;"
                onmouseover="this.style.backgroundColor='#c8e6dc'; this.style.borderColor='#2d7a6b'"
                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#7bb899'">
                Registrar Antecedentes
            </a>
    @if($historia->antecedentes->isEmpty())
        <p class="text-gray-500">No hay antecedentes registrados para esta historia clínica.</p>
    @else
        <ul class="space-y-3 text-gray-700">
            @foreach ($historia->antecedentes as $ant)
                <li class="border-b pb-2">
                    <strong>{{ $ant->tipoAntecedente->tipa_nombre }}
                    @if ($ant->ant_detalle)
                        <div class="text-sm text-gray-600 mt-1">Detalle: {{ $ant->ant_detalle }}</div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-app-layout>
