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

                    {{-- Paciente --}}
                    <div class="mb-4">
                        <label for="paciente_id" class="block">Paciente</label>
                        <select name="paciente_id" id="paciente_id" class="w-full border-gray-300 rounded">
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->pac_cedula }}" 
                                    {{ old('paciente_id', $cita->paciente_id) == $paciente->pac_cedula ? 'selected' : '' }}>
                                    {{ $paciente->pac_nombres }} {{ $paciente->pac_apellidos }}
                                </option>
                            @endforeach
                        </select>
                        @error('paciente_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Doctor --}}
                    <div class="mb-4">
                        <label for="doctor_id" class="block">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full border-gray-300 rounded">
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->doc_cedula }}" 
                                    {{ old('doctor_id', $cita->doctor_id) == $doctor->doc_cedula ? 'selected' : '' }}>
                                    {{ $doctor->doc_nombres }} {{ $doctor->doc_apellidos }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tipo de Cita --}}
                    <div class="mb-4">
                        <label for="tipc_id" class="block">Tipo de Cita</label>
                        <select name="tipc_id" id="tipc_id" class="w-full border-gray-300 rounded">
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->tipc_id }}" 
                                    {{ old('tipc_id', $cita->tipc_id) == $tipo->tipc_id ? 'selected' : '' }}>
                                    {{ $tipo->tipc_nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipc_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-4">
                        <label for="estc_id" class="block">Estado</label>
                        <select name="estc_id" id="estc_id" class="w-full border-gray-300 rounded">
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->estc_id }}" 
                                    {{ old('estc_id', $cita->estc_id) == $estado->estc_id ? 'selected' : '' }}>
                                    {{ $estado->estc_nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('estc_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="cit_fecha" class="block">Fecha</label>
                        <input type="date" name="cit_fecha" id="cit_fecha" class="w-full border-gray-300 rounded"
                            value="{{ old('cit_fecha', $cita->cit_fecha) }}" required>
                        @error('cit_fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Hora Inicio --}}
                    <div class="mb-4">
                        <label for="cit_hora_inicio" class="block">Hora Inicio</label>
                        <input type="time" name="cit_hora_inicio" id="cit_hora_inicio" class="w-full border-gray-300 rounded"
                            value="{{ old('cit_hora_inicio', $cita->cit_hora_inicio) }}" required>
                        @error('cit_hora_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Hora Fin --}}
                    <div class="mb-4">
                        <label for="cit_hora_fin" class="block">Hora Fin</label>
                        <input type="time" name="cit_hora_fin" id="cit_hora_fin" class="w-full border-gray-300 rounded"
                            value="{{ old('cit_hora_fin', $cita->cit_hora_fin) }}" required>
                        @error('cit_hora_fin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Motivo de Consulta --}}
                    <div class="mb-4">
                        <label for="cit_motivo_consulta" class="block">Motivo</label>
                        <textarea name="cit_motivo_consulta" id="cit_motivo_consulta"
                            class="w-full border-gray-300 rounded" rows="3">{{ old('cit_motivo_consulta', $cita->cit_motivo_consulta) }}</textarea>
                        @error('cit_motivo_consulta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Botón --}}
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
