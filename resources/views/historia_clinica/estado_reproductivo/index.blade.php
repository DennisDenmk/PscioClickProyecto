<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Estado Reproductivo</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">

        {{-- Si tienes la variable $his_id, pásala así: --}}
        <a href="{{ route('estado_reproductivo.create', $his_id ?? ($estados->first()->est_his_id ?? '') ) }}"
            class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">
            + Nuevo Estado
        </a>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Historia</th>
                    <th class="px-4 py-2">¿Embarazada?</th>
                    <th class="px-4 py-2"># Hijos</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estados as $estado)
                    <tr class="border-t">
                        <td class="px-4 py-2">#{{ $estado->est_his_id }}</td>
                        <td class="px-4 py-2">
                            {{ $estado->est_esta_embarazada ? 'Sí' : 'No' }}
                        </td>
                        <td class="px-4 py-2">{{ $estado->est_cantidad_hijos }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('estado_reproductivo.edit', $estado->est_id) }}"
                                class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
