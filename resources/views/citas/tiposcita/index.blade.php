<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Tipos de Citas
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto">
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        <a href="{{route('tipocita.create')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Añadir nuevo tipo de cita
                </a>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Nombre</th>
                    <th class="px-4 py-2 border-b">Duración (min)</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $tipo->tipc_nombre }}</td>
                        <td class="px-4 py-2 border-b">{{ $tipo->tipc_duracion_minutos }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('tipocita.edit', $tipo->tipc_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
