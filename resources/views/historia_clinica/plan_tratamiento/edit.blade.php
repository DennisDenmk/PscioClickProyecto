<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Plan de Tratamiento</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('plan_tratamiento.update', $plan->pla_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">
                    Historia Clínica #{{ $plan->historiaClinica->pac_id }} 
                    @if($plan->historiaClinica->paciente)
                        - {{ $plan->historiaClinica->paciente->pac_nombres }} {{ $plan->historiaClinica->paciente->pac_apellidos }}
                    @endif
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Diagnóstico</label>
                <input type="text" name="pla_diagnostico" class="w-full border px-3 py-2 rounded" value="{{ $plan->pla_diagnostico }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Objetivo del Tratamiento</label>
                <textarea name="pla_objetivo_tratamiento" class="w-full border px-3 py-2 rounded" rows="2" required>{{ $plan->pla_objetivo_tratamiento }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Tratamiento</label>
                <textarea name="pla_tratamiento" class="w-full border px-3 py-2 rounded" rows="3" required>{{ $plan->pla_tratamiento }}</textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
        </form>
    </div>
</x-app-layout>
