<x-app-layout>
    <x-slot name="header">Editar Detalle</x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('detalles.update', $detalle->deth_id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Display original date and time (read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="fecha_original" value="Fecha de valoración original" />
                    <x-text-input name="fecha_original" type="date"
                        value="{{ $detalle->deth_fecha_valoracion }}"
                        readonly
                        class="bg-gray-100" />
                </div>
                <div>
                    <label for="hora_original" class="block text-sm font-medium text-gray-700">Hora de valoración original</label>
                    <input type="time" name="hora_original" id="hora_original"
                        value="{{ $detalle->deth_hora }}"
                        readonly
                        class="w-full border-gray-300 rounded bg-gray-100 mt-1">
                </div>
            </div>

            <x-input-label for="deth_motivo_consulta" value="Motivo de consulta" />
            <textarea name="deth_motivo_consulta" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('deth_motivo_consulta', $detalle->deth_motivo_consulta) }}</textarea>
            @error('deth_motivo_consulta')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" />
            <textarea name="deth_tratamientos_previos" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_tratamientos_previos', $detalle->deth_tratamientos_previos) }}</textarea>
            @error('deth_tratamientos_previos')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="deth_peso" value="Peso (kg)" />
                    <x-text-input name="deth_peso" type="number" step="0.10"
                        value="{{ old('deth_peso', $detalle->deth_peso) }}" required />
                    @error('deth_peso')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="deth_talla" value="Talla (m)" />
                    <x-text-input name="deth_talla" type="number" step="0.01"
                        value="{{ old('deth_talla', $detalle->deth_talla) }}" required />
                    @error('deth_talla')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="deth_imc" value="IMC" />
                    <x-text-input name="deth_imc" type="number" step="0.01"
                        value="{{ old('deth_imc', $detalle->deth_imc) }}" readonly class="bg-gray-100" />
                </div>
            </div>

            <x-input-label for="deth_lado_dolor" value="Lado de dolor" />
            <x-text-input name="deth_lado_dolor"
                value="{{ old('deth_lado_dolor', $detalle->deth_lado_dolor) }}" />
            @error('deth_lado_dolor')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-input-label for="deth_exploracion_fisica" value="Exploración física" />
            <textarea name="deth_exploracion_fisica" rows="4"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_exploracion_fisica', $detalle->deth_exploracion_fisica) }}</textarea>
            @error('deth_exploracion_fisica')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="flex gap-4">
                <x-primary-button>Actualizar Detalle</x-primary-button>
                <a href="{{ route('historia_clinica.home', $detalle->his_id) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- JavaScript para calcular IMC automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pesoInput = document.querySelector('input[name="deth_peso"]');
            const tallaInput = document.querySelector('input[name="deth_talla"]');
            const imcInput = document.querySelector('input[name="deth_imc"]');

            function calcularIMC() {
                const peso = parseFloat(pesoInput.value);
                const talla = parseFloat(tallaInput.value);

                if (peso && talla && talla > 0) {
                    const imc = peso / (talla * talla);
                    imcInput.value = imc.toFixed(2);
                } else {
                    imcInput.value = '';
                }
            }

            pesoInput.addEventListener('input', calcularIMC);
            tallaInput.addEventListener('input', calcularIMC);
        });
    </script>
</x-app-layout>
