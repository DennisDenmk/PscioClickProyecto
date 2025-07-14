<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Evaluaciones - Historia Clínica #{{ $his_id }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        <a href="{{ route('evaluaciones.create', $his_id) }}"
           class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">+ Nueva Evaluación</a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if ($evaluaciones->isEmpty())
            <p>No hay evaluaciones registradas para esta historia clínica.</p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Evaluación Dolor</th>
                        <th class="px-4 py-2">Escala Dolor (0-10)</th>
                        <th class="px-4 py-2">Exámenes Complementarios</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluaciones as $eva)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $eva->eva_evaluacion_dolor }}</td>
                            <td class="px-4 py-2">{{ $eva->eva_escala_dolor }}</td>
                            <td class="px-4 py-2">{{ $eva->eva_examenes_complementarios ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $eva->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('evaluaciones.edit', $eva->eva_id) }}" class="text-blue-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
