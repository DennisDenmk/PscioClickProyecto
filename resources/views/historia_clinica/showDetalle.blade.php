<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Detalles de Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="mb-4">
            <h3 class="text-lg font-bold">Paciente: {{ $historia->paciente->pac_nombres }}
                {{ $historia->paciente->pac_apellidos }}</h3>
            <p>Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <div class="mb-6">
            <a href="{{ route('detalles.create', $historia->his_id) }}"
                class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700 border-gray-300">
                + Agregar Detalle
            </a>
        </div>
        <div class="mb-6">
            <a href="{{ route('habitos.create', $historia->his_id) }}" class="text-green-600 hover:underline">Registrar Habitos</a>
        </div>

        @if ($historia->detallesHistoria->isEmpty())
            <p class="text-gray-500">No hay detalles registrados.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Fecha</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Motivo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Peso</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Talla</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($historia->detallesHistoria as $detalle)
                        <tr>
                            <td class="px-4 py-2">{{ $detalle->deth_fecha_valoracion }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_motivo_consulta }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_peso }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_talla }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                |
                                <a href="{{ route('signos.create', $historia->his_id) }}"
                                    class="px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                                    + Agregar Signos Vitales
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <h3 class="text-md font-semibold mb-2">Signos Vitales</h3>
                @if ($historia->signosVitales->isEmpty())
                    <p class="text-gray-500">No hay signos vitales registrados.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">TA</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">FC</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">FR</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">SpO₂</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">Temp</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($historia->signosVitales as $signo)
                                <tr>
                                    <td class="px-4 py-2">
                                        {{ $signo->sig_tension_arterial_sistolica }}/{{ $signo->sig_tension_arterial_diastolica }}
                                    </td>
                                    <td class="px-4 py-2">{{ $signo->sig_frecuencia_cardiaca }}</td>
                                    <td class="px-4 py-2">{{ $signo->sig_frecuencia_respiratoria }}</td>
                                    <td class="px-4 py-2">{{ $signo->sig_saturacion_oxigeno }}%</td>
                                    <td class="px-4 py-2">{{ $signo->sig_temperatura }}°C</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('signos.edit', $signo->sig_id) }}"
                                            class="text-blue-600 hover:underline">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </table>
        @endif
    </div>
</x-app-layout>
