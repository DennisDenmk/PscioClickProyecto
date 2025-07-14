<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Evaluación</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-10">
        <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->eva_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Evaluación de Dolor</label>
                <input type="text" name="eva_evaluacion_dolor" value="{{ old('eva_evaluacion_dolor', $evaluacion->eva_evaluacion_dolor) }}" class="w-full border px-3 py-2" required>
                @error('eva_evaluacion_dolor') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Escala de Dolor (0 a 10)</label>
                <input type="number" name="eva_escala_dolor" min="0" max="10" value="{{ old('eva_escala_dolor', $evaluacion->eva_escala_dolor) }}" class="w-full border px-3 py-2" required>
                @error('eva_escala_dolor') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Exámenes Complementarios</label>
                <textarea name="eva_examenes_complementarios" rows="3" class="w-full border px-3 py-2">{{ old('eva_examenes_complementarios', $evaluacion->eva_examenes_complementarios) }}</textarea>
            </div>

            <x-primary-button>Actualizar Evaluación</x-primary-button>
        </form>
    </div>
</x-app-layout>
