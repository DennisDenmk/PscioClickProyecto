<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Horario</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('horarios_doctor.update', $horario->hor_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Doctor</label>
                <select name="doc_cedula" class="w-full border p-2">
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->doc_cedula }}" {{ $doctor->doc_cedula == $horario->doc_cedula ? 'selected' : '' }}>
                            {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Día de Semana</label>
                <input type="text" name="hor_dia_semana" value="{{ $horario->hor_dia_semana }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Hora Inicio</label>
                <input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label>Hora Fin</label>
                <input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label>Fecha específica</label>
                <input type="date" name="hor_fecha_especifica" value="{{ $horario->hor_fecha_especifica }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>¿Disponible?</label>
                <select name="hor_disponible" class="w-full border p-2">
                    <option value="1" {{ $horario->hor_disponible ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$horario->hor_disponible ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
