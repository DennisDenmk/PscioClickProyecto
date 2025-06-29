<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Estados Civiles</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <a href="{{ route('estado_civil.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded">+ Nuevo</a>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estados as $estado)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $estado->estc_id }}</td>
                        <td class="px-4 py-2">{{ $estado->estc_nombre }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('estado_civil.edit', $estado->estc_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
