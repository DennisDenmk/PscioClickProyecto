<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Registrar Estado Reproductivo</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_reproductivo.store') }}">
            @csrf

            <div class="mb-4">
                <label>Historia Clínica</label>
                <select name="est_his_id" class="w-full border px-3 py-2">
                    @foreach ($historias as $historia)
                        <option value="{{ $historia->his_id }}">Historia #{{ $historia->his_id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>¿Está embarazada?</label>
                <select name="est_esta_embarazada" class="w-full border px-3 py-2">
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Cantidad de hijos</label>
                <input type="number" name="est_cantidad_hijos" min="0" class="w-full border px-3 py-2" required>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
