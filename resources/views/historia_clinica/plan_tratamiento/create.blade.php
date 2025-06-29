<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nuevo Plan de Tratamiento</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('plan_tratamiento.store') }}">
            @csrf

            <div class="mb-4">
                <label>Historia Clínica</label>
                <select name="pla_his_id" class="w-full border px-3 py-2">
                    @foreach($historias as $historia)
                        <option value="{{ $historia->his_id }}">Historia #{{ $historia->his_id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Diagnóstico</label>
                <input type="text" name="pla_diagnostico" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Objetivo del Tratamiento</label>
                <input type="text" name="pla_objetivo_tratamiento" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Tratamiento</label>
                <input type="text" name="pla_tratamiento" class="w-full border px-3 py-2" required>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
