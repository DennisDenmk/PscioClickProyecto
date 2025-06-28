<x-app-layout>
    <x-slot name="header">Lista de Promociones de Citas</x-slot>

    <div class="py-6">
        <a href="{{ route('promocioncita.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ Nuevo</a>

        <table class="mt-4 w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th>ID</th>
                    <th>Cita</th>
                    <th>Promoción</th>
                    <th>Sesiones Usadas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promocionesCitas as $item)
                    <tr>
                        <td>{{ $item->proc_cit_id }}</td>
                        <td>{{ $item->cita->cit_id ?? 'N/A' }}</td>
                        <td>{{ $item->promocion->prom_nombre ?? 'N/A' }}</td>
                        <td>{{ $item->proc_sesiones_usadas }}</td>
                        <td>
                            <a href="{{ route('promocioncita.edit', $item->proc_cit_id) }}" class="text-blue-600">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

