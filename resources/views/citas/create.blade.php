<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Crear Cita</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Nueva Cita</h3>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <ul class="text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('citas.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label for="paciente_cedula" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cédula del Paciente
                                </label>
                                <div class="flex gap-2">
                                    <input type="text" name="paciente_id" id="paciente_cedula"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('paciente_id') }}" maxlength="10" pattern="[0-9]{10}"
                                        inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                                    <button type="button" id="btnBuscarPaciente"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        Buscar
                                    </button>
                                </div>
                                @error('paciente_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                                    <p id="paciente_nombre" class="text-gray-900 py-1">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Apellido:</label>
                                    <p id="paciente_apellido" class="text-gray-900 py-1">-</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                            <select name="doctor_id" id="doctor_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->doc_cedula }}"
                                        {{ old('doctor_id') == $doctor->doc_cedula ? 'selected' : '' }}>
                                        {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="tipc_id" class="block text-sm font-medium text-gray-700 mb-1">Tipo de
                                Cita</label>
                            <select name="tipc_id" id="tipc_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->tipc_id }}"
                                        data-duracion="{{ $tipo->tipc_duracion_minutos }}"
                                        {{ old('tipc_id') == $tipo->tipc_id ? 'selected' : '' }}>
                                        {{ $tipo->tipc_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipc_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="estc_id" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <select name="estc_id" id="estc_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->estc_id }}"
                                        {{ old('estc_id') == $estado->estc_id ? 'selected' : '' }}>
                                        {{ $estado->estc_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estc_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="cit_fecha"
                                    class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                                <input type="date" name="cit_fecha" id="cit_fecha"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('cit_fecha') }}" required>
                                @error('cit_fecha')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <div class="mb-4">
                                    <label for="cit_hora_inicio" class="block">Hora Inicio</label>
                                    <input type="time" name="cit_hora_inicio" id="cit_hora_inicio"
                                        class="w-full border-gray-300 rounded" value="{{ old('cit_hora_inicio') }}"
                                        required>
                                    @error('cit_hora_inicio')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cit_hora_fin" class="block text-sm font-medium text-gray-700 mb-1">Hora
                                        Fin</label>
                                    <input type="text" name="cit_hora_fin" id="cit_hora_fin"
                                        class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm"
                                        value="{{ old('cit_hora_fin') }}" readonly required>
                                </div>
                            </div>

                            <div>
                                <label for="cit_motivo_consulta"
                                    class="block text-sm font-medium text-gray-700 mb-1">Motivo</label>
                                <textarea name="cit_motivo_consulta" id="cit_motivo_consulta" rows="3"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('cit_motivo_consulta') }}</textarea>
                                @error('cit_motivo_consulta')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors">
                                Guardar Cita
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Citas del Día Seleccionado</h3>
                    <div id="tarjetas_citas">
                        <div class="text-gray-500 text-center py-8">
                            No hay citas cargadas.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // Variables comunes
    const pacienteCedulaInput = document.getElementById('paciente_cedula');
    const pacienteNombreEl = document.getElementById('paciente_nombre');
    const pacienteApellidoEl = document.getElementById('paciente_apellido');
    const btnBuscarPaciente = document.getElementById('btnBuscarPaciente');

    const fechaInput = document.getElementById('cit_fecha');
    const tarjetasCitas = document.getElementById('tarjetas_citas');

    const tipoCitaSelect = document.getElementById('tipc_id');
    const horaInicioInput = document.getElementById('cit_hora_inicio');
    const horaFinInput = document.getElementById('cit_hora_fin');

    // Función para buscar y mostrar datos del paciente
    function fetchPacienteData(cedula) {
        if (cedula === '') {
            pacienteNombreEl.textContent = '-';
            pacienteApellidoEl.textContent = '-';
            return;
        }

        fetch(`/pacientes/buscar/${cedula}`)
            .then(response => {
                if (!response.ok) throw new Error('Paciente no encontrado');
                return response.json();
            })
            .then(data => {
                pacienteNombreEl.textContent = data.nombres;
                pacienteApellidoEl.textContent = data.apellidos;
            })
            .catch(() => {
                pacienteNombreEl.textContent = '-';
                pacienteApellidoEl.textContent = '-';
                alert('Paciente no encontrado');
            });
    }

    // Función para calcular y mostrar la hora de fin
    function calcularHoraFin() {
        const selectedOption = tipoCitaSelect.options[tipoCitaSelect.selectedIndex];
        const duracion = parseInt(selectedOption?.dataset.duracion || 0);

        const horaInicio = horaInicioInput.value;
        if (!horaInicio || isNaN(duracion)) {
            horaFinInput.value = '';
            return;
        }

        const [horas, minutos] = horaInicio.split(':').map(Number);
        const inicio = new Date();
        inicio.setHours(horas, minutos + duracion);

        const hh = String(inicio.getHours()).padStart(2, '0');
        const mm = String(inicio.getMinutes()).padStart(2, '0');

        horaFinInput.value = `${hh}:${mm}`;
    }

    // Función para cargar las citas del día seleccionado
    function cargarCitasDelDia(fecha) {
        if (!fecha) {
            tarjetasCitas.innerHTML =
                '<div class="text-gray-500 text-center py-8">Seleccione una fecha para ver las citas.</div>';
            return;
        }

        fetch(`/citas/por-fecha/${fecha}`)
            .then(res => res.json())
            .then(data => {
                tarjetasCitas.innerHTML = '';

                if (data.length === 0) {
                    tarjetasCitas.innerHTML =
                        '<div class="text-gray-500 text-center py-8">No hay citas para esta fecha.</div>';
                    return;
                }

                data.forEach(cita => {
                    const card = document.createElement('div');
                    card.className = 'p-4 border border-gray-300 rounded-lg shadow-sm bg-white mb-2';

                    card.innerHTML = `
                    <p class="text-sm text-gray-800"><strong>Hora:</strong> ${cita.hora}</p>
                    <p class="text-sm text-gray-800"><strong>Paciente:</strong> ${cita.paciente}</p>
                    <p class="text-sm text-gray-800"><strong>Doctor:</strong> Dr. ${cita.doctor}</p>
                `;

                    tarjetasCitas.appendChild(card);
                });
            })
            .catch(() => {
                tarjetasCitas.innerHTML = '<div class="text-red-500 text-center py-8">Error al cargar citas.</div>';
            });
    }

    // Event Listeners
    btnBuscarPaciente.addEventListener('click', function() {
        fetchPacienteData(pacienteCedulaInput.value.trim());
    });

    tipoCitaSelect.addEventListener('change', calcularHoraFin);
    horaInicioInput.addEventListener('change', calcularHoraFin);
    fechaInput.addEventListener('change', function() {
        cargarCitasDelDia(this.value);
    });

    // Código que se ejecuta cuando el DOM está completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Flatpickr para el campo de Hora Inicio
        flatpickr(horaInicioInput, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Formato de 24 horas para el valor
            time_24hr: true, // Forzar visualización de 24 horas en el picker
            minuteIncrement: 5 // Para que los minutos vayan de 5 en 5, como es común en citas
        });

        // NOTA: No inicializamos Flatpickr para horaFinInput porque es un campo calculado y de solo lectura.

        // Si hay un valor antiguo para paciente_id (ej. después de un error de validación), cargar sus datos
        if (pacienteCedulaInput.value) {
            fetchPacienteData(pacienteCedulaInput.value);
        }

        // Calcular la hora de fin si ya hay una hora de inicio y tipo de cita seleccionados (ej. al volver de un error de validación)
        calcularHoraFin();

        // Cargar citas para la fecha inicial (si hay una fecha ya seleccionada, ej. al volver de un error de validación)
        if (fechaInput.value) {
            cargarCitasDelDia(fechaInput.value);
        }
    });
</script>
