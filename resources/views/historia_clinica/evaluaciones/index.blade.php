<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Evaluaciones</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <a href="{{ route('evaluaciones.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Nueva Evaluación</a>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Historia</th>
                    <th class="px-4 py-2">Evaluación Dolor</th>
                    <th class="px-4 py-2">Escala Dolor</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluaciones as $eva)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $eva->eva_id }}</td>
                        <td class="px-4 py-2">{{ $eva->historiaClinica->his_id }}</td>
                        <td class="px-4 py-2">{{ $eva->eva_evaluacion_dolor }}</td>
                        <td class="px-4 py-2">{{ $eva->eva_escala_dolor }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('evaluaciones.edit', $eva->eva_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
