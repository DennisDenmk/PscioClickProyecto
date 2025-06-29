<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Agregar Enfermedad Actual</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('enfermedad_actual.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">ID Historia Clínica</label>
                <input type="number" name="enf_his_id" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Tipo de Enfermedad</label>
                <select name="enf_tipo_id" class="w-full border px-3 py-2" required>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->tipo_enf_id }}">{{ $tipo->tipo_enf_nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <textarea name="enf_descripcion" class="w-full border px-3 py-2" required></textarea>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
