<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nuevo Tipo de Enfermedad</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('tipo_enfermedad_actual.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nombre</label>
                <input type="text" name="tipo_enf_nombre" class="w-full border px-3 py-2" required>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
