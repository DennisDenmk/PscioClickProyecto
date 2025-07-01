<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Nuevo Horario</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('horarios_doctor.store') }}" class="space-y-6 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Doctor</label>
                <select name="doc_cedula" required class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->doc_cedula }}">
                            {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="hor_dia_semana" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Día de Semana</label>
                <input type="number" id="hor_dia_semana" name="hor_dia_semana" min="1" max="7" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Hora Inicio</label>
                <input type="time" name="hora_inicio" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Hora Fin</label>
                <input type="time" name="hora_fin" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Fecha específica (opcional)</label>
                <input type="date" name="hor_fecha_especifica"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">¿Disponible?</label>
                <select name="hor_disponible" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow transition duration-300">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>
