<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Estado Civil</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_civil.update', $estado->estc_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Nombre</label>
                <input type="text" name="estc_nombre" class="w-full border px-3 py-2" value="{{ $estado->estc_nombre }}" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
