<div class="bg-white shadow rounded p-6 mt-6">
    <h4 class="text-lg font-medium text-gray-800 mb-4">Enfermedades Actuales</h4>

    @if($historia->enfermedadesActuales->isEmpty())
        <p class="text-gray-500">No hay enfermedades actuales registradas.</p>
    @else
        <ul class="space-y-3 text-gray-700">
            @foreach ($historia->enfermedadesActuales as $enf)
                <li class="border-b pb-2">
                    <strong>{{ $enf->tipoEnfermedad->tipo_enf_nombre }}</strong>
                    <div class="text-sm text-gray-600 mt-1">Descripción: {{ $enf->enf_descripcion }}</div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
