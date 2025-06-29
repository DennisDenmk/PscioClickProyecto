<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Estado Reproductivo</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('estado_reproductivo.update', $estado->est_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Historia Clínica</label>
                <select name="est_his_id" class="w-full border px-3 py-2">
                    @foreach ($historias as $historia)
                        <option value="{{ $historia->his_id }}" {{ $estado->est_his_id == $historia->his_id ? 'selected' : '' }}>
                            Historia #{{ $historia->his_id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>¿Está embarazada?</label>
                <select name="est_esta_embarazada" class="w-full border px-3 py-2">
                    <option value="si" {{ $estado->est_esta_embarazada == 'si' ? 'selected' : '' }}>Sí</option>
                    <option value="no" {{ $estado->est_esta_embarazada == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Cantidad de hijos</label>
                <input type="number" name="est_cantidad_hijos" class="w-full border px-3 py-2" value="{{ $estado->est_cantidad_hijos }}" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
