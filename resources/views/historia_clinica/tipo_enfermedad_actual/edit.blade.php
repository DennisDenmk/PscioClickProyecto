<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Tipo de Enfermedad</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('tipo_enfermedad_actual.update', $tipo->tipo_enf_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Nombre</label>
                <input type="text" name="tipo_enf_nombre" class="w-full border px-3 py-2" value="{{ $tipo->tipo_enf_nombre }}" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
