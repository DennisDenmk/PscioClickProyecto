<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Planes de Tratamiento</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <a href="{{ route('plan_tratamiento.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">+ Nuevo Plan</a>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Historia</th>
                    <th class="px-4 py-2">Diagnóstico</th>
                    <th class="px-4 py-2">Objetivo</th>
                    <th class="px-4 py-2">Tratamiento</th>
                    <th class="px-4 py-2">Fecha de creacion</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planes as $plan)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $plan->pla_his_id }}</td>
                        <td class="px-4 py-2">{{ $plan->pla_diagnostico }}</td>
                        <td class="px-4 py-2">{{ $plan->pla_objetivo_tratamiento}}</td>
                        <td class="px-4 py-2">{{ $plan->pla_tratamiento }}</td>
                        <td class="px-4 py-2">{{ $plan->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('plan_tratamiento.edit', $plan->pla_id) }}" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
