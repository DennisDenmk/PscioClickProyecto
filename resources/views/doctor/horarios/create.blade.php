<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nuevo Horario</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('horarios_doctor.store') }}">
            @csrf

            <div class="mb-4">
                <label>Doctor</label>
                <select name="doc_cedula" class="w-full border p-2">
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->doc_cedula }}">{{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="hor_dia_semana">Día de Semana</label>
                <input type="number" id="hor_dia_semana" name="hor_dia_semana" min="1" max="7" required
                    class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Hora Inicio</label>
                <input type="time" name="hora_inicio" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label>Hora Fin</label>
                <input type="time" name="hora_fin" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label>Fecha específica (opcional)</label>
                <input type="date" name="hor_fecha_especifica" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>¿Disponible?</label>
                <select name="hor_disponible" class="w-full border p-2" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
