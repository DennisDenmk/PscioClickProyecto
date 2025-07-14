<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Registrar Estado Reproductivo - Historia Clínica #{{ $historia->his_id }}</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_reproductivo.store', $historia->his_id) }}">
            @csrf

            {{-- No necesitas seleccionar la historia porque viene en la URL --}}
            
            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">¿Está embarazada?</label>
                <select name="est_esta_embarazada" class="w-full border px-3 py-2 rounded" required>
                    <option value="">-- Selecciona --</option>
                    <option value="1" {{ old('est_esta_embarazada') == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('est_esta_embarazada') == '0' ? 'selected' : '' }}>No</option>
                </select>
                <x-input-error :messages="$errors->get('est_esta_embarazada')" class="mt-1" />
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Cantidad de hijos</label>
                <input type="number" name="est_cantidad_hijos" min="0" class="w-full border px-3 py-2 rounded" value="{{ old('est_cantidad_hijos') }}" required>
                <x-input-error :messages="$errors->get('est_cantidad_hijos')" class="mt-1" />
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
        </form>
    </div>
</x-app-layout>
