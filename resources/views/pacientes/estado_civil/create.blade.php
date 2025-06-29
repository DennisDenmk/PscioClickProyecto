<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nuevo Estado Civil</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_civil.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Nombre</label>
                <input type="text" name="estc_nombre" class="w-full border px-3 py-2" required>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
