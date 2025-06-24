<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Lista de Historias Clínicas
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6">

            @if ($historias->isEmpty())
                <p class="text-gray-600">No hay historias clínicas registradas.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Paciente</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Cédula</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Fecha</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($historias as $historia)
                            <tr>
                                <td class="px-4 py-2">{{ $historia->his_id }}</td>
                                <td class="px-4 py-2">{{ $historia->paciente->pac_nombres }}
                                    {{ $historia->paciente->pac_apellidos }}</td>
                                <td class="px-4 py-2">{{ $historia->paciente->pac_cedula }}</td>
                                <td class="px-4 py-2">{{ $historia->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('historias.show', $historia->his_id) }}"
                                        class="text-blue-600 hover:underline">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
