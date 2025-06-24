<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Detalles de Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="mb-4">
            <h3 class="text-lg font-bold">Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}</h3>
            <p>Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <div class="mb-6">
            <a href="{{ route('detalles.create', $historia->his_id) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Agregar Detalle
            </a>
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
                    @foreach($historia->detallesHistoria as $detalle)
                        <tr>
                            <td class="px-4 py-2">{{ $detalle->deth_fecha_valoracion }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_motivo_consulta }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_peso }}</td>
                            <td class="px-4 py-2">{{ $detalle->deth_talla }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('detalles.edit', $detalle->deth_id) }}" class="text-blue-600 hover:underline">Editar</a>
                                |
                                <form action="{{ route('detalles.destroy', $detalle->deth_id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
