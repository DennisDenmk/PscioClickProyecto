<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Evaluación</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->eva_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="eva_his_id">Historia Clínica</label>
                <select name="eva_his_id" id="eva_his_id" class="w-full border p-2" required>
                    @foreach ($historias as $his)
                        <option value="{{ $his->his_id }}"
                            {{ $his->his_id == $evaluacion->eva_his_id ? 'selected' : '' }}>
                            {{ $his->his_id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="eva_evaluacion_dolor">Evaluación Dolor</label>
                <textarea name="eva_evaluacion_dolor" id="eva_evaluacion_dolor" class="w-full border p-2" required>{{ $evaluacion->eva_evaluacion_dolor }}</textarea>
            </div>

            <div class="mb-4">
                <label for="eva_escala_dolor">Escala Dolor</label>
                <input type="number" id="eva_escala_dolor" name="eva_escala_dolor" min="0" max="10"
                    class="w-full border p-2" value="{{ $evaluacion->eva_escala_dolor }}" required>
            </div>

            <div class="mb-4">
                <label for="eva_examenes_complementarios">Exámenes Complementarios</label>
                <textarea name="eva_examenes_complementarios" id="eva_examenes_complementarios" class="w-full border p-2" required>{{ $evaluacion->eva_examenes_complementarios }}</textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
