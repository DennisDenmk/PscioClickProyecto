@props(['paciente' => null, 'estadosCiviles'])

@php
    $isEdit = !is_null($paciente);
@endphp

@csrf

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block">Cédula</label>
        <input type="text" name="pac_cedula" maxlength="10" class="form-input w-full"
               value="{{ old('pac_cedula', $paciente->pac_cedula ?? '') }}" {{ $isEdit ? 'readonly' : 'required' }}>
    </div>

    <div>
        <label class="block">Nombres</label>
        <input type="text" name="pac_nombres" class="form-input w-full"
               value="{{ old('pac_nombres', $paciente->pac_nombres ?? '') }}" required>
    </div>

    <div>
        <label class="block">Apellidos</label>
        <input type="text" name="pac_apellidos" class="form-input w-full"
               value="{{ old('pac_apellidos', $paciente->pac_apellidos ?? '') }}" required>
    </div>

    <div>
        <label class="block">Sexo</label>
        <select name="pac_sexo" class="form-select w-full" required>
            <option value="1" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
            <option value="0" {{ old('pac_sexo', $paciente->pac_sexo ?? '') == 0 ? 'selected' : '' }}>Femenino</option>
        </select>
    </div>

    <div>
        <label class="block">Fecha de Nacimiento</label>
        <input type="date" name="pac_fecha_nacimiento" class="form-input w-full"
               value="{{ old('pac_fecha_nacimiento', $paciente->pac_fecha_nacimiento ?? '') }}" required>
    </div>

    <div>
        <label class="block">Estado Civil</label>
        <select name="estc_id" class="form-select w-full" required>
            @foreach($estadosCiviles as $estado)
                <option value="{{ $estado->estc_id }}"
                    {{ old('estc_id', $paciente->estc_id ?? '') == $estado->estc_id ? 'selected' : '' }}>
                    {{ $estado->estc_nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block">Profesión</label>
        <input type="text" name="pac_profesion" class="form-input w-full"
               value="{{ old('pac_profesion', $paciente->pac_profesion ?? '') }}">
    </div>

    <div>
        <label class="block">Ocupación</label>
        <input type="text" name="pac_ocupacion" class="form-input w-full"
               value="{{ old('pac_ocupacion', $paciente->pac_ocupacion ?? '') }}">
    </div>

    <div>
        <label class="block">Teléfono</label>
        <input type="text" name="pac_telefono" class="form-input w-full"
               value="{{ old('pac_telefono', $paciente->pac_telefono ?? '') }}">
    </div>

    <div class="col-span-2">
        <label class="block">Dirección</label>
        <textarea name="pac_direccion" class="form-textarea w-full">{{ old('pac_direccion', $paciente->pac_direccion ?? '') }}</textarea>
    </div>

    <div class="col-span-2">
        <label class="block">Email</label>
        <input type="email" name="pac_email" class="form-input w-full"
               value="{{ old('pac_email', $paciente->pac_email ?? '') }}">
    </div>
</div>
