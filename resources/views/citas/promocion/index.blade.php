<x-app-layout>
    <x-slot name="header">Lista de Promociones</x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <a href="{{ route('promociones.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ Nueva Promoción</a>
        
        <table class="mt-4 w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Sesiones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promociones as $promocion)
                <tr>
                    <td>{{ $promocion->prom_nombre }}</td>
                    <td>{{ $promocion->prom_descripcion }}</td>
                    <td>$ {{ number_format($promocion->prom_precio, 2) }}</td>
                    <td>{{ $promocion->prom_sesiones }}</td>
                    <td>
                        <a href="{{ route('promociones.edit', $promocion->prom_id) }}" class="text-blue-500 hover:underline">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
