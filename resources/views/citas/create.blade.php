<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg sm:text-xl font-semibold leading-tight text-gray-800">Crear Cita</h2>
    </x-slot>

    <div class="py-4 sm:py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <!-- Grid que se adapta: 1 columna en móvil, 2 en desktop -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 sm:gap-6">

                <!-- Formulario de Nueva Cita -->
                <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6 order-2 xl:order-1">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Nueva Cita</h3>

                    @if ($errors->any())
                        <div class="mb-4 p-3 sm:p-4 bg-red-50 border border-red-200 rounded-lg">
                            <ul class="text-xs sm:text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('citas.store') }}" method="POST" class="space-y-4 sm:space-y-5">
                        @csrf

                        <!-- Sección Paciente -->
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <label for="paciente_cedula" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                                    Cédula del Paciente
                                </label>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <input type="text" name="paciente_id" id="paciente_cedula"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        value="{{ old('paciente_id') }}" maxlength="10" pattern="[0-9]{10}"
                                        inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                                    <button type="button" id="btnBuscarPaciente"
                                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors text-sm font-medium">
                                        Buscar
                                    </button>
                                </div>
                                @error('paciente_id')
                                    <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Info del Paciente -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 bg-gray-50 p-3 sm:p-4 rounded-lg">
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700">Nombre:</label>
                                    <p id="paciente_nombre" class="text-gray-900 text-sm sm:text-base py-1 truncate">-</p>
                                </div>
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700">Apellido:</label>
                                    <p id="paciente_apellido" class="text-gray-900 text-sm sm:text-base py-1 truncate">-</p>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor -->
                        <div>
                            <label for="doctor_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Doctor</label>
                            <select name="doctor_id" id="doctor_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->doc_cedula }}"
                                        {{ old('doctor_id') == $doctor->doc_cedula ? 'selected' : '' }}>
                                        {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo de Cita y Estado en una fila en desktop -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <label for="tipc_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Tipo de Cita</label>
                                <select name="tipc_id" id="tipc_id"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->tipc_id }}"
                                            data-duracion="{{ $tipo->tipc_duracion_minutos }}"
                                            {{ old('tipc_id') == $tipo->tipc_id ? 'selected' : '' }}>
                                            {{ $tipo->tipc_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipc_id')
                                    <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="estc_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Estado</label>
                                <select name="estc_id" id="estc_id"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->estc_id }}"
                                            {{ old('estc_id') == $estado->estc_id ? 'selected' : '' }}>
                                            {{ $estado->estc_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estc_id')
                                    <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha, Horas y Motivo -->
                        <div class="space-y-4">
                            <!-- Fecha -->
                            <div>
                                <label for="cit_fecha" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Fecha</label>
                                <input type="date" name="cit_fecha" id="cit_fecha"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                    value="{{ old('cit_fecha') }}" required>
                                @error('cit_fecha')
                                    <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Horas en grid responsive -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <label for="cit_hora_inicio" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Hora Inicio</label>
                                    <input type="time" name="cit_hora_inicio" id="cit_hora_inicio"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                        value="{{ old('cit_hora_inicio') }}" required>
                                    @error('cit_hora_inicio')
                                        <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cit_hora_fin" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Hora Fin</label>
                                    <input type="text" name="cit_hora_fin" id="cit_hora_fin"
                                        class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm text-sm"
                                        value="{{ old('cit_hora_fin') }}" readonly required>
                                </div>
                            </div>

                            <!-- Motivo -->
                            <div>
                                <label for="cit_motivo_consulta" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Motivo de Consulta</label>
                                <textarea name="cit_motivo_consulta" id="cit_motivo_consulta" rows="3"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm resize-none"
                                    placeholder="Describe el motivo de la consulta..."
                                    required>{{ old('cit_motivo_consulta') }}</textarea>
                                @error('cit_motivo_consulta')
                                    <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-white py-2.5 px-4 rounded-md transition-colors text-sm sm:text-base font-medium">
                                Guardar Cita
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Panel de Citas del Día -->
                <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6 order-1 xl:order-2">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Citas del Día Seleccionado</h3>
                    <div id="tarjetas_citas" class="space-y-3">
                        <div class="text-gray-500 text-center py-6 sm:py-8 text-sm">
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
                '<div class="text-gray-500 text-center py-6 sm:py-8 text-sm">Seleccione una fecha para ver las citas.</div>';
            return;
        }

        fetch(`/citas/por-fecha/${fecha}`)
            .then(res => res.json())
            .then(data => {
                tarjetasCitas.innerHTML = '';

                if (data.length === 0) {
                    tarjetasCitas.innerHTML =
                        '<div class="text-gray-500 text-center py-6 sm:py-8 text-sm">No hay citas para esta fecha.</div>';
                    return;
                }

                data.forEach(cita => {
                    const card = document.createElement('div');
                    card.className = 'p-3 sm:p-4 border border-gray-200 rounded-lg shadow-sm bg-white hover:shadow-md transition-shadow';

                    card.innerHTML = `
                        <div class="space-y-1 sm:space-y-2">
                            <p class="text-xs sm:text-sm text-gray-800"><strong>Hora:</strong> ${cita.hora}</p>
                            <p class="text-xs sm:text-sm text-gray-800"><strong>Paciente:</strong> <span class="break-words">${cita.paciente}</span></p>
                            <p class="text-xs sm:text-sm text-gray-800"><strong>Doctor:</strong> <span class="break-words">Dr. ${cita.doctor}</span></p>
                        </div>
                    `;

                    tarjetasCitas.appendChild(card);
                });
            })
            .catch(() => {
                tarjetasCitas.innerHTML = '<div class="text-red-500 text-center py-6 sm:py-8 text-sm">Error al cargar citas.</div>';
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
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 5
        });

        // Si hay un valor antiguo para paciente_id, cargar sus datos
        if (pacienteCedulaInput.value) {
            fetchPacienteData(pacienteCedulaInput.value);
        }

        // Calcular la hora de fin si ya hay valores
        calcularHoraFin();

        // Cargar citas para la fecha inicial
        if (fechaInput.value) {
            cargarCitasDelDia(fechaInput.value);
        }
    });
</script>
