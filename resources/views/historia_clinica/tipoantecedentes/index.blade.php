<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Tipos de Antecedentes</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <a href="{{ route('tipo_antecedente.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">+ Crear nuevo</a>

        @if(session('success'))
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
                        <td class="px-4 py-2">{{ $tipo->tipa_id }}</td>
                        <td class="px-4 py-2">{{ $tipo->tipa_nombre }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('tipo_antecedente.edit', $tipo->tipa_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
