<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Enfermedades Actuales</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <a href="{{ route('enfermedad_actual.create') }}" class="mb-4 px-4 py-2 bg-green-600 text-white rounded">+ Agregar Enfermedad</a>
        <a href="{{ route('tipo_enfermedad_actual.index') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                    Crear Tipo de enfermadad Actual
                </a>
        @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Historia</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enfermedades as $enf)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $enf->enf_id }}</td>
                        <td class="px-4 py-2">#{{ $enf->historiaClinica->his_id ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $enf->tipoEnfermedad->tipo_enf_nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $enf->enf_descripcion }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('enfermedad_actual.edit', $enf->enf_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
