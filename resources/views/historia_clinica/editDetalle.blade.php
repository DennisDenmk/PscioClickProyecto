<x-app-layout>
<form action="{{ route('detalles.update', $detalle->deth_id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="deth_fecha_valoracion">Fecha de valoración</label>
    <input type="date" name="deth_fecha_valoracion" value="{{ old('deth_fecha_valoracion', $detalle->deth_fecha_valoracion) }}" required>

    <label for="deth_hora">Hora</label>
    <input type="time" name="deth_hora" value="{{ old('deth_hora', $detalle->deth_hora) }}" required>

    <label for="deth_motivo_consulta">Motivo de consulta</label>
    <textarea name="deth_motivo_consulta" required>{{ old('deth_motivo_consulta', $detalle->deth_motivo_consulta) }}</textarea>

    <label for="deth_tratamientos_previos">Tratamientos previos</label>
    <textarea name="deth_tratamientos_previos">{{ old('deth_tratamientos_previos', $detalle->deth_tratamientos_previos) }}</textarea>

    <label for="deth_peso">Peso (kg)</label>
    <input type="number" step="0.1" name="deth_peso" value="{{ old('deth_peso', $detalle->deth_peso) }}" required>

    <label for="deth_talla">Talla (cm)</label>
    <input type="number" step="0.1" name="deth_talla" value="{{ old('deth_talla', $detalle->deth_talla) }}" required>

    <label for="deth_imc">IMC</label>
    <input type="number" step="0.01" name="deth_imc" value="{{ old('deth_imc', $detalle->deth_imc) }}" required>

    <label for="deth_lado_dolor">Lado de dolor</label>
    <input type="text" name="deth_lado_dolor" value="{{ old('deth_lado_dolor', $detalle->deth_lado_dolor) }}">

    <label for="deth_exploracion_fisica">Exploración física</label>
    <textarea name="deth_exploracion_fisica">{{ old('deth_exploracion_fisica', $detalle->deth_exploracion_fisica) }}</textarea>

    <button type="submit">Guardar Detalle</button>
</form>
</x-app-layout>
