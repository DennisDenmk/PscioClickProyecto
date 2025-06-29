<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nueva Evaluación</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('evaluaciones.store') }}">
            @csrf

            <div class="mb-4">
                <label>Historia Clínica</label>
                <select name="eva_his_id" class="w-full border p-2">
                    @foreach ($historias as $his)
                        <option value="{{ $his->his_id }}">{{ $his->his_id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Evaluación Dolor</label>
                <textarea name="eva_evaluacion_dolor" class="w-full border p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="eva_escala_dolor">Escala Dolor</label>
                <input type="number" id="eva_escala_dolor" name="eva_escala_dolor" min="0" max="10"
                    class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Exámenes Complementarios</label>
                <textarea name="eva_examenes_complementarios" class="w-full border p-2"></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
