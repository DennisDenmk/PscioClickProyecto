<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Plan de Tratamiento</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('plan_tratamiento.update', $plan->pla_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Historia Clínica</label>
                <select name="pla_his_id" class="w-full border px-3 py-2">
                    @foreach($historias as $historia)
                        <option value="{{ $historia->his_id }}" {{ $plan->pla_his_id == $historia->his_id ? 'selected' : '' }}>
                            Historia #{{ $historia->his_id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Diagnóstico</label>
                <input type="text" name="pla_diagnostico" class="w-full border px-3 py-2" value="{{ $plan->pla_diagnostico }}" required>
            </div>

            <div class="mb-4">
                <label>Objetivo del Tratamiento</label>
                <input type="text" name="pla_objetivo_tratamiento" class="w-full border px-3 py-2" value="{{ $plan->pla_objetivo_tratamiento }}" required>
            </div>

            <div class="mb-4">
                <label>Tratamiento</label>
                <input type="text" name="pla_tratamiento" class="w-full border px-3 py-2" value="{{ $plan->pla_tratamiento }}" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
