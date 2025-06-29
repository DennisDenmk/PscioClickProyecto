<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Enfermedad Actual</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('enfermedad_actual.update', $enfermedad->enf_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Tipo de Enfermedad</label>
                <select name="enf_tipo_id" class="w-full border px-3 py-2" required>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->tipo_enf_id }}" @selected($enfermedad->enf_tipo_id == $tipo->tipo_enf_id)>
                            {{ $tipo->tipo_enf_nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <textarea name="enf_descripcion" class="w-full border px-3 py-2" required>{{ $enfermedad->enf_descripcion }}</textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
