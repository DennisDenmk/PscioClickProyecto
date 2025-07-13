<div class="bg-white shadow rounded p-6 mt-6">
    <h4 class="text-lg font-medium text-gray-800 mb-4">Antecedentes Registrados</h4>

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
