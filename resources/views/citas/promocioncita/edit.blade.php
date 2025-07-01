<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Editar Promoción de Cita</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <form action="{{ route('promocioncita.update', $promocionCita->proc_cit_id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="cit_id" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Cita</label>
                <select id="cit_id" name="cit_id"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700 
                           text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($citas as $cita)
                        <option value="{{ $cita->cit_id }}" {{ $promocionCita->cit_id == $cita->cit_id ? 'selected' : '' }}>
                            {{ $cita->cit_id }} - {{ $cita->paciente->pac_nombres ?? 'Paciente' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="proc_id" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Promoción</label>
                <select id="proc_id" name="proc_id"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700 
                           text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($promociones as $promo)
                        <option value="{{ $promo->prom_id }}" {{ $promocionCita->proc_id == $promo->prom_id ? 'selected' : '' }}>
                            {{ $promo->prom_nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="proc_sesiones_usadas" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Sesiones Usadas</label>
                <input type="number" id="proc_sesiones_usadas" name="proc_sesiones_usadas" min="0" required
                       value="{{ $promocionCita->proc_sesiones_usadas }}"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-white dark:bg-gray-700 
                              text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <button type="submit" 
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow 
                           transition duration-300">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
