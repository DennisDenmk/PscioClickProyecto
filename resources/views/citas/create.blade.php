<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Crear Cita</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf

                    {{-- Paciente --}}
                    <div class="mb-4">
                        {{-- Cédula del Paciente --}}
                        <div class="mb-4">
                            <label for="paciente_cedula" class="block">Cédula del Paciente</label>
                            <div class="flex space-x-2">
                                <input type="text" name="paciente_id" id="paciente_cedula"
                                    class="w-full border-gray-300 rounded" value="{{ old('paciente_id') }}" required>

                                <button type="button" id="btnBuscarPaciente"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Buscar
                                </button>
                            </div>
                            @error('paciente_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mostrar datos del paciente --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <p id="paciente_nombre" class="text-gray-900 dark:text-white">-</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Apellido:</label>
                            <p id="paciente_apellido" class="text-gray-900 dark:text-white">-</p>
                        </div>
                    </div>

                    {{-- Doctor --}}
                    <div class="mb-4">
                        <label for="doctor_id" class="block">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full border-gray-300 rounded">
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

                    {{-- Tipo de Cita --}}
                    <div class="mb-4">
                        <label for="tipc_id" class="block">Tipo de Cita</label>
                        <select name="tipc_id" id="tipc_id" class="w-full border-gray-300 rounded">
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->tipc_id }}" data-duracion="{{ $tipo->tipc_duracion_minutos }}"
                                    {{ old('tipc_id') == $tipo->tipc_id ? 'selected' : '' }}>
                                    {{ $tipo->tipc_nombre }}
                                </option>
                            @endforeach

                        </select>
                        @error('tipc_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-4">
                        <label for="estc_id" class="block">Estado</label>
                        <select name="estc_id" id="estc_id" class="w-full border-gray-300 rounded">
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

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="cit_fecha" class="block">Fecha</label>
                        <input type="date" name="cit_fecha" id="cit_fecha" class="w-full border-gray-300 rounded"
                            value="{{ old('cit_fecha') }}" required>
                        @error('cit_fecha')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Hora Inicio --}}
                    <div class="mb-4">
                        <label for="cit_hora_inicio" class="block">Hora Inicio</label>
                        <input type="time" name="cit_hora_inicio" id="cit_hora_inicio"
                            class="w-full border-gray-300 rounded" value="{{ old('cit_hora_inicio') }}" required>
                        @error('cit_hora_inicio')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Hora Fin --}}
                    <div class="mb-4">
                        <label for="cit_hora_fin" class="block">Hora Fin</label>
                        <input type="time" name="cit_hora_fin" id="cit_hora_fin"
                            class="w-full border-gray-300 rounded bg-gray-100" value="{{ old('cit_hora_fin') }}"
                            readonly required>

                    </div>

                    {{-- Motivo --}}
                    <div class="mb-4">
                        <label for="cit_motivo_consulta" class="block">Motivo</label>
                        <textarea name="cit_motivo_consulta" id="cit_motivo_consulta" class="w-full border-gray-300 rounded" required
                            rows="3">{{ old('cit_motivo_consulta') }}</textarea>
                        @error('cit_motivo_consulta')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
            <div id="citas_del_dia" class="mt-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-700">Citas del día</h3>
                <div id="tarjetas_citas">
                    <div class="text-gray-500">No hay citas cargadas.</div>
                </div>
            </div>


        </div>

    </div>
</x-app-layout>
<script>
    
   const fechaInput = document.getElementById('cit_fecha');
    const tarjetasCitas = document.getElementById('tarjetas_citas');

fechaInput.addEventListener('change', function () {
    const fecha = fechaInput.value;
    if (!fecha) return;

    fetch(`/citas/por-fecha/${fecha}`)
        .then(res => res.json())
        .then(data => {
            tarjetasCitas.innerHTML = '';

            if (data.length === 0) {
                tarjetasCitas.innerHTML = '<div class="text-gray-500">No hay citas para esta fecha.</div>';
                return;
            }

            data.forEach(cita => {
                const card = document.createElement('div');
                card.className = 'p-4 border border-gray-300 rounded-lg shadow-sm bg-white';

                card.innerHTML = `
                    <p class="text-sm text-gray-800"><strong>Hora:</strong> ${cita.hora}</p>
                    <p class="text-sm text-gray-800"><strong>Paciente:</strong> ${cita.paciente}</p>
                    <p class="text-sm text-gray-800"><strong>Doctor:</strong> Dr. ${cita.doctor}</p>
                `;

                tarjetasCitas.appendChild(card);
            });
        })
        .catch(() => {
            tarjetasCitas.innerHTML = '<div class="text-red-500">Error al cargar citas.</div>';
        });
});
    document.addEventListener('DOMContentLoaded', function() {
        const tipoCitaSelect = document.getElementById('tipc_id');
        const horaInicioInput = document.getElementById('cit_hora_inicio');
        const horaFinInput = document.getElementById('cit_hora_fin');

        function calcularHoraFin() {
            const selectedOption = tipoCitaSelect.options[tipoCitaSelect.selectedIndex];
            const duracion = parseInt(selectedOption.dataset.duracion || 0);

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

        tipoCitaSelect.addEventListener('change', calcularHoraFin);
        horaInicioInput.addEventListener('change', calcularHoraFin);
    });
    document.getElementById('btnBuscarPaciente').addEventListener('click', function() {
        const cedula = document.getElementById('paciente_cedula').value.trim();

        if (cedula === '') return alert('Ingrese una cédula');

        fetch(`/pacientes/buscar/${cedula}`)
            .then(response => {
                if (!response.ok) throw new Error('Paciente no encontrado');
                return response.json();
            })
            .then(data => {
                document.getElementById('paciente_nombre').textContent = data.nombres;
                document.getElementById('paciente_apellido').textContent = data.apellidos;
            })
            .catch(() => {
                document.getElementById('paciente_nombre').textContent = '-';
                document.getElementById('paciente_apellido').textContent = '-';
                alert('Paciente no encontrado');
            });
    });
</script>
