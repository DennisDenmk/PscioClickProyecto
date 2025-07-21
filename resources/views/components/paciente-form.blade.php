@props(['paciente' => null, 'estadosCiviles'])

@php
    $isEdit = !is_null($paciente);
@endphp

@csrf

<div class="bg-white shadow rounded-lg overflow-hidden p-6">
    <!-- Vista de formulario para pantallas grandes -->
    <div class="hidden lg:block">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Cédula</label>
                <input type="text" name="pac_cedula" maxlength="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_cedula', $paciente->pac_cedula ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Nombres</label>
                <input type="text" name="pac_nombres"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_nombres', $paciente->pac_nombres ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Apellidos</label>
                <input type="text" name="pac_apellidos"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_apellidos', $paciente->pac_apellidos ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Sexo</label>
                <select name="pac_sexo"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="1" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="0" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 0 ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Fecha de Nacimiento</label>
                <input type="date" name="pac_fecha_nacimiento"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_fecha_nacimiento', $paciente->pac_fecha_nacimiento ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Estado Civil</label>
                <select name="estc_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    @foreach ($estadosCiviles as $estado)
                        <option value="{{ $estado->estc_id }}"
                            {{ old('estc_id', $paciente->estc_id ?? '') == $estado->estc_id ? 'selected' : '' }}>
                            {{ $estado->estc_nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Profesión</label>
                <input type="text" name="pac_profesion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_profesion', $paciente->pac_profesion ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Ocupación</label>
                <input type="text" name="pac_ocupacion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_ocupacion', $paciente->pac_ocupacion ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Teléfono</label>
                <input type="text" name="pac_telefono" id="pac_telefono" maxlength="10" pattern="[0-9]{10}"
                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_telefono', $paciente->pac_telefono ?? '') }}">
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Dirección</label>
                <textarea name="pac_direccion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    rows="3">{{ old('pac_direccion', $paciente->pac_direccion ?? '') }}</textarea>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="pac_email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_email', $paciente->pac_email ?? '') }}">
            </div>
        </div>
    </div>

    <!-- Vista de formulario para tablets -->
    <div class="block lg:hidden hidden md:block">
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Cédula</label>
                    <input type="text" name="pac_cedula" maxlength="10"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('pac_cedula', $paciente->pac_cedula ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Nombres</label>
                    <input type="text" name="pac_nombres"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('pac_nombres', $paciente->pac_nombres ?? '') }}" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Apellidos</label>
                    <input type="text" name="pac_apellidos"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('pac_apellidos', $paciente->pac_apellidos ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Sexo</label>
                    <select name="pac_sexo"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="1" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
                        <option value="0" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 0 ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Fecha de Nacimiento</label>
                    <input type="date" name="pac_fecha_nacimiento"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('pac_fecha_nacimiento', $paciente->pac_fecha_nacimiento ?? '') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Estado Civil</label>
                    <select name="estc_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        @foreach ($estadosCiviles as $estado)
                            <option value="{{ $estado->estc_id }}"
                                {{ old('estc_id', $paciente->estc_id ?? '') == $estado->estc_id ? 'selected' : '' }}>
                                {{ $estado->estc_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Profesión</label>
                    <input type="text" name="pac_profesion"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                        value="{{ old('pac_profesion', $paciente->pac_profesion ?? '') }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Ocupación</label>
                    <input type="text" name="pac_ocupacion"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                        value="{{ old('pac_ocupacion', $paciente->pac_ocupacion ?? '') }}">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-2">Teléfono</label>
                <input type="text" name="pac_telefono" id="pac_telefono_tablet" maxlength="10" pattern="[0-9]{10}"
                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_telefono', $paciente->pac_telefono ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-2">Dirección</label>
                <textarea name="pac_direccion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    rows="3">{{ old('pac_direccion', $paciente->pac_direccion ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-2">Email</label>
                <input type="email" name="pac_email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_email', $paciente->pac_email ?? '') }}">
            </div>
        </div>
    </div>

    <!-- Vista compacta para móviles -->
    <div class="block md:hidden">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Cédula</label>
                <input type="text" name="pac_cedula" maxlength="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_cedula', $paciente->pac_cedula ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Nombres</label>
                <input type="text" name="pac_nombres"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_nombres', $paciente->pac_nombres ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Apellidos</label>
                <input type="text" name="pac_apellidos"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_apellidos', $paciente->pac_apellidos ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Sexo</label>
                <select name="pac_sexo"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="1" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="0" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 0 ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="pac_fecha_nacimiento"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_fecha_nacimiento', $paciente->pac_fecha_nacimiento ?? '') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Estado Civil</label>
                <select name="estc_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    @foreach ($estadosCiviles as $estado)
                        <option value="{{ $estado->estc_id }}"
                            {{ old('estc_id', $paciente->estc_id ?? '') == $estado->estc_id ? 'selected' : '' }}>
                            {{ $estado->estc_nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Profesión</label>
                <input type="text" name="pac_profesion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_profesion', $paciente->pac_profesion ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="pac_ocupacion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_ocupacion', $paciente->pac_ocupacion ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Teléfono</label>
                <input type="text" name="pac_telefono" id="pac_telefono_mobile" maxlength="10" pattern="[0-9]{10}"
                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('pac_telefono', $paciente->pac_telefono ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Dirección</label>
                <textarea name="pac_direccion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    rows="3">{{ old('pac_direccion', $paciente->pac_direccion ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" name="pac_email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required
                    value="{{ old('pac_email', $paciente->pac_email ?? '') }}">
            </div>
        </div>
    </div>
</div>
