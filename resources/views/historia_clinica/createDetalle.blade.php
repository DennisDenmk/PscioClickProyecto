<x-app-layout>
    <x-slot name="header">Añadir Detalle</x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('detalles.store', $his_id) }}" method="POST" class="space-y-4">
            @csrf

            <x-input-label for="deth_fecha_valoracion" value="Fecha de valoración" />
            <x-text-input name="deth_fecha_valoracion" type="date" required />

            <div class="mb-4">
                <label for="deth_hora" class="block">Hora Inicio</label>
                <input type="time" name="deth_hora" id="deth_hora" class="w-full border-gray-300 rounded"
                    value="{{ old('deth_hora') }}" required>
                @error('deth_hora')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <x-input-label for="deth_motivo_consulta" value="Motivo de consulta" />
            <textarea name="deth_motivo_consulta" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('deth_motivo_consulta') }}</textarea>

            <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" />
            <textarea name="deth_tratamientos_previos" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_tratamientos_previos') }}</textarea>

            <x-input-label for="deth_peso" value="Peso (kg)" />
            <x-text-input name="deth_peso" type="number" step="0.10" required />

            <x-input-label for="deth_talla" value="Talla (m)" />
            <x-text-input name="deth_talla" type="number" step="0.10" required />

            <x-input-label for="deth_imc" value="IMC" />
            <x-text-input name="deth_imc" type="number" step="0.010" required />

            <x-input-label for="deth_lado_dolor" value="Lado de dolor" />
            <x-text-input name="deth_lado_dolor" />

            <x-input-label for="deth_exploracion_fisica" value="Exploración física" />
            <textarea name="deth_exploracion_fisica" rows="4"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_exploracion_fisica') }}</textarea>

            <x-primary-button>Guardar Detalle</x-primary-button>
        </form>
    </div>
</x-app-layout>
  
