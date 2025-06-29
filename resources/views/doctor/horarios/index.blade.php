<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Horarios de Doctores</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <a href="{{ route('horarios_doctor.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Nuevo Horario</a>

        @if (session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="w-full mt-6 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Doctor</th>
                    <th class="px-4 py-2">Día</th>
                    <th class="px-4 py-2">Inicio</th>
                    <th class="px-4 py-2">Fin</th>
                    <th class="px-4 py-2">Fecha específica</th>
                    <th class="px-4 py-2">Disponible</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horarios as $h)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $h->doctor->doc_nombres }} {{ $h->doctor->doc_apellidos }}</td>
                        <td class="px-4 py-2">{{ $h->hor_dia_semana ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $h->hora_inicio }}</td>
                        <td class="px-4 py-2">{{ $h->hora_fin }}</td>
                        <td class="px-4 py-2">{{ $h->hor_fecha_especifica ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $h->hor_disponible ? 'Sí' : 'No' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('horarios_doctor.edit', $h->hor_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
