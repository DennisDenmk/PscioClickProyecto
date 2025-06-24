<form action="{{ route('detalles.update', $detalle->deth_id) }}" method="POST">
    @csrf
    @method('PUT')
    <x-input-label for="deth_fecha_valoracion" value="Fecha de valoración" />
            <x-text-input name="deth_fecha_valoracion" type="date" required />

            <x-input-label for="deth_hora" value="Hora" />
            <x-text-input name="deth_hora" type="time" required />

            <x-input-label for="deth_motivo_consulta" value="Motivo de consulta" />
            <x-textarea name="deth_motivo_consulta" required></x-textarea>

            <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" />
            <x-textarea name="deth_tratamientos_previos"></x-textarea>

            <x-input-label for="deth_peso" value="Peso (kg)" />
            <x-text-input name="deth_peso" type="number" step="0.1" required />

            <x-input-label for="deth_talla" value="Talla (cm)" />
            <x-text-input name="deth_talla" type="number" step="0.1" required />

            <x-input-label for="deth_imc" value="IMC" />
            <x-text-input name="deth_imc" type="number" step="0.01" required />

            <x-input-label for="deth_lado_dolor" value="Lado de dolor" />
            <x-text-input name="deth_lado_dolor" />

            <x-input-label for="deth_exploracion_fisica" value="Exploración física" />
            <x-textarea name="deth_exploracion_fisica"></x-textarea>

            <x-primary-button>Guardar Detalle</x-primary-button>
        </form>
    </div>
</x-app-layout>
