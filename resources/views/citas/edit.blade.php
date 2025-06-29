<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Editar Cita</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('citas.update', $cita->cit_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block">Paciente</label>
                        <select name="paciente_id" class="w-full border-gray-300 rounded">
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->pac_cedula }}" {{ $paciente->pac_cedula == $cita->paciente_id ? 'selected' : '' }}>
                                    {{ $paciente->pac_nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Doctor</label>
                        <select name="doctor_id" class="w-full border-gray-300 rounded">
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->doc_cedula }}" {{ $doctor->doc_cedula == $cita->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->doc_nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Tipo de Cita</label>
                        <select name="tipc_id" class="w-full border-gray-300 rounded">
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->tipc_id }}" {{ $tipo->tipc_id == $cita->tipc_id ? 'selected' : '' }}>
                                    {{ $tipo->tipc_nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Estado</label>
                        <select name="estc_id" class="w-full border-gray-300 rounded">
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->estc_id }}" {{ $estado->estc_id == $cita->estc_id ? 'selected' : '' }}>
                                    {{ $estado->estc_nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Fecha</label>
                        <input type="date" name="cit_fecha" value="{{ $cita->cit_fecha }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block">Hora Inicio</label>
                        <input type="time" name="cit_hora_inicio" value="{{ $cita->cit_hora_inicio }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block">Hora Fin</label>
                        <input type="time" name="cit_hora_fin" value="{{ $cita->cit_hora_fin }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block">Motivo</label>
                        <textarea name="cit_motivo_consulta" class="w-full border-gray-300 rounded">{{ $cita->cit_motivo_consulta }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>