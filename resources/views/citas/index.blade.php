<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Lista de Citas</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('citas.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ Nueva Cita</a>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paciente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($citas as $cita)
                            <tr>
                                <td class="px-6 py-4">{{ $cita->paciente->pac_nombres }}</td>
                                <td class="px-6 py-4">{{ $cita->doctor->doc_nombres }}</td>
                                <td class="px-6 py-4">{{ $cita->cit_fecha }}</td>
                                <td class="px-6 py-4">{{ $cita->cit_hora_inicio }} - {{ $cita->cit_hora_fin }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('citas.edit', $cita->cit_id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>