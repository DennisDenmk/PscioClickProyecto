<x-app-layout>
    <x-slot name="header">Añadir Detalle</x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('detalles.store', $his_id) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Display current date and time (read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="fecha_actual" value="Fecha de valoración" />
                    <x-text-input name="fecha_actual" type="date"
                        value="{{ now()->format('Y-m-d') }}"
                        readonly
                        class="bg-gray-100" />
                </div>
                <div>
                    <label for="hora_actual" class="block text-sm font-medium text-gray-700">Hora de valoración</label>
                    <input type="time" name="hora_actual" id="hora_actual"
                        value="{{ now()->format('H:i') }}"
                        readonly
                        class="w-full border-gray-300 rounded bg-gray-100 mt-1">
                </div>
            </div>

            <x-input-label for="deth_motivo_consulta" value="Motivo de consulta" />
            <textarea name="deth_motivo_consulta" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('deth_motivo_consulta') }}</textarea>

            <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" />
            <textarea name="deth_tratamientos_previos" rows="3"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_tratamientos_previos') }}</textarea>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="deth_peso" value="Peso (kg)" />
                    <x-text-input name="deth_peso" type="number" step="0.10" required />
                </div>
                <div>
                    <x-input-label for="deth_talla" value="Talla (m)" />
                    <x-text-input name="deth_talla" type="number" step="0.01" required />
                </div>
                <div>
                    <x-input-label for="deth_imc" value="IMC" />
                    <x-text-input name="deth_imc" type="number" step="0.01" readonly class="bg-gray-100" />
                </div>
            </div>

            <x-input-label for="deth_lado_dolor" value="Lado de dolor" />
            <x-text-input name="deth_lado_dolor" />

            <x-input-label for="deth_exploracion_fisica" value="Exploración física" />
            <textarea name="deth_exploracion_fisica" rows="4"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('deth_exploracion_fisica') }}</textarea>

            <x-primary-button>Guardar Detalle</x-primary-button>
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
