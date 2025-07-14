<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Estado Reproductivo - Historia Clínica #{{ $estado->est_his_id }}</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_reproductivo.update', $estado->est_id) }}">
            @csrf
            @method('PUT')

            {{-- Historia clínica (solo muestra, no editable) --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Historia Clínica</label>
                <input type="text" class="w-full border px-3 py-2 rounded bg-gray-100" value="Historia #{{ $estado->est_his_id }}" disabled>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">¿Está embarazada?</label>
                <select name="est_esta_embarazada" class="w-full border px-3 py-2 rounded" required>
                    <option value="1" {{ $estado->est_esta_embarazada == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $estado->est_esta_embarazada == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Cantidad de hijos</label>
                <input type="number" name="est_cantidad_hijos" class="w-full border px-3 py-2 rounded" value="{{ $estado->est_cantidad_hijos }}" min="0" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
        </form>
    </div>
</x-app-layout>
