<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Editar Cita</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Formulario - Lado Izquierdo -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Editar Cita</h3>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <ul class="text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('citas.update', $cita->cit_id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Paciente -->
                        <div class="space-y-4">
                            <!-- Cédula del Paciente -->
                            <div>
                                <label for="paciente_cedula" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cédula del Paciente
                                </label>
                                <div class="flex gap-2">
                                    <input type="text" name="paciente_id" id="paciente_cedula"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('paciente_id', $cita->paciente_id) }}" required>
                                    <button type="button" id="btnBuscarPaciente"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        Buscar
                                    </button>
                                </div>
                                @error('paciente_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Datos del paciente -->
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

                        <!-- Doctor -->
                        <div>
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                            <select name="doctor_id" id="doctor_id" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->doc_cedula }}"
                                        {{ old('doctor_id', $cita->doctor_id) == $doctor->doc_cedula ? 'selected' : '' }}>
                                        {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo de Cita -->
                        <div>
                            <label for="tipc_id" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Cita</label>
                            <select name="tipc_id" id="tipc_id" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->tipc_id }}"
                                        data-duracion="{{ $tipo->tipc_duracion_minutos }}"
                                        {{ old('tipc_id', $cita->tipc_id) == $tipo->tipc_id ? 'selected' : '' }}>
                                        {{ $tipo->tipc_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipc_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="estc_id" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <select name="estc_id" id="estc_id" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->estc_id }}"
                                        {{ old('estc_id', $cita->estc_id) == $estado->estc_id ? 'selected' : '' }}>
                                        {{ $estado->estc_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estc_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fecha y Horarios -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="cit_fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                                <input type="date" name="cit_fecha" id="cit_fecha" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('cit_fecha', $cita->cit_fecha) }}" required>
                                @error('cit_fecha')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="cit_hora_inicio" class="block text-sm font-medium text-gray-700 mb-1">Hora Inicio</label>
                                <input type="time" name="cit_hora_inicio" id="cit_hora_inicio"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('cit_hora_inicio', substr($cita->cit_hora_inicio, 0, 5)) }}" required>
                                @error('cit_hora_inicio')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="cit_hora_fin" class="block text-sm font-medium text-gray-700 mb-1">Hora Fin</label>
                                <input type="time" name="cit_hora_fin" id="cit_hora_fin"
                                    class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm"
                                    value="{{ old('cit_hora_fin', substr($cita->cit_hora_fin, 0, 5)) }}" readonly required>
                            </div>
                        </div>

                        <!-- Motivo -->
                        <div>
                            <label for="cit_motivo_consulta" class="block text-sm font-medium text-gray-700 mb-1">Motivo</label>
                            <textarea name="cit_motivo_consulta" id="cit_motivo_consulta" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>{{ old('cit_motivo_consulta', $cita->cit_motivo_consulta) }}</textarea>
                            @error('cit_motivo_consulta')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-2 pt-4">
                            <a href="{{ route('citas.index') }}" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-md text-center transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors">
                                Actualizar Cita
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Citas del Día Seleccionado - Lado Derecho -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Citas del Día Seleccionado</h3>
                    <div id="tarjetas_citas">
                        <div class="text-gray-500 text-center py-8">
                            Cargando citas...
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
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
                alert('Paciente no encontrado'); // Solo alerta si se busca explícitamente
            });
    }

    // Función para calcular y mostrar la hora de fin
    function calcularHoraFin() {
        const selectedOption = tipoCitaSelect.options[tipoCitaSelect.selectedIndex];
        // Asegúrate de que selectedOption no sea null y tenga dataset
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

    // Función para cargar las citas del día
    function cargarCitasDelDia(fecha) {
        if (!fecha) {
            tarjetasCitas.innerHTML = '<div class="text-gray-500 text-center py-8">Seleccione una fecha para ver las citas.</div>';
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
                    card.className = 'p-4 border border-gray-300 rounded-lg shadow-sm bg-white mb-2'; // Added mb-2 for spacing

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

    // Cargar datos iniciales al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Cargar datos del paciente actual
        fetchPacienteData(pacienteCedulaInput.value);

        // Calcular hora de fin inicial
        calcularHoraFin();

        // Cargar citas para la fecha actual de la cita
        cargarCitasDelDia(fechaInput.value);
    });
</script>
```