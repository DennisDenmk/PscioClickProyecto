<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tipos de Enfermedad Actual</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <a href="{{ route('tipo_enfermedad_actual.create') }}" class="mb-4 px-4 py-2 bg-green-600 text-white rounded">+ Nuevo Tipo</a>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipos as $tipo)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $tipo->tipo_enf_id }}</td>
                        <td class="px-4 py-2">{{ $tipo->tipo_enf_nombre }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('tipo_enfermedad_actual.edit', $tipo->tipo_enf_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
