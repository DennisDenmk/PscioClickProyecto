<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Editar Horario</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('horarios_doctor.update', $horario->hor_id) }}" class="space-y-6 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Doctor</label>
                <select name="doc_cedula" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->doc_cedula }}" {{ $doctor->doc_cedula == $horario->doc_cedula ? 'selected' : '' }}>
                            {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Día de Semana</label>
                <input type="text" name="hor_dia_semana" value="{{ $horario->hor_dia_semana }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Hora Inicio</label>
                <input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Hora Fin</label>
                <input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha específica</label>
                <input type="date" name="hor_fecha_especifica" value="{{ $horario->hor_fecha_especifica }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">¿Disponible?</label>
                <select name="hor_disponible" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ $horario->hor_disponible ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$horario->hor_disponible ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow transition duration-300">
                Actualizar
            </button>
        </form>
    </div>
</x-app-layout>
