<x-app-layout>
    <x-slot name="header">Añadir Detalle</x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('detalles.store', $his_id) }}" method="POST" class="space-y-4">
            @csrf

            <x-input-label for="deth_fecha_valoracion" value="Fecha de valoración" />
            <x-text-input name="deth_fecha_valoracion" type="date" required />

            <x-input-label for="deth_hora" value="Hora" />
            <x-text-input name="deth_hora" type="time" required />

            <x-input-label for="deth_motivo_consulta" value="Motivo de consulta" />
            <textarea name="deth_motivo_consulta" rows="3"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                      required>{{ old('deth_motivo_consulta') }}</textarea>

            <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" />
            <textarea name="deth_tratamientos_previos" rows="3"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_tratamientos_previos') }}</textarea>

            <x-input-label for="deth_peso" value="Peso (kg)" />
            <x-text-input name="deth_peso" type="number" step="0.1" required />

            <x-input-label for="deth_talla" value="Talla (m)" />
            <x-text-input name="deth_talla" type="number" step="0.1" required />

            <x-input-label for="deth_imc" value="IMC" />
            <x-text-input name="deth_imc" type="number" step="0.01" required />

            <x-input-label for="deth_lado_dolor" value="Lado de dolor" />
            <x-text-input name="deth_lado_dolor" />

            <x-input-label for="deth_exploracion_fisica" value="Exploración física" />
            <textarea name="deth_exploracion_fisica" rows="4"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_exploracion_fisica') }}</textarea>

            <x-primary-button>Guardar Detalle</x-primary-button>
        </form>
    </div>
</x-app-layout>
