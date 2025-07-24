<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Añadir Detalle de Consulta
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="text-red-800 font-medium mb-2">Por favor corrige los siguientes errores:</div>
                <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Información de la Consulta</h3>
                <p class="text-sm text-gray-600 mt-1">Complete los detalles de la consulta médica</p>
            </div>

            <form action="{{ route('detalles.store', $his_id) }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Fecha y Hora -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="fecha_actual" value="Fecha de valoración" class="text-gray-700" />
                        <x-text-input
                            name="fecha_actual"
                            type="date"
                            value="{{ now()->format('Y-m-d') }}"
                            readonly
                            class="mt-1 bg-gray-100 border-gray-300 focus:ring-[#0b5d63] focus:border-[#0b5d63]" />
                    </div>
                    <div>
                        <label for="hora_actual" class="block text-sm font-medium text-gray-700">Hora de valoración</label>
                        <input
                            type="time"
                            name="hora_actual"
                            id="hora_actual"
                            value="{{ now()->format('H:i') }}"
                            readonly
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 focus:ring-[#0b5d63] focus:border-[#0b5d63]">
                    </div>
                </div>

                <!-- Motivo de Consulta -->
                <div>
                    <x-input-label for="deth_motivo_consulta" value="Motivo de consulta *" class="text-gray-700" />
                    <textarea
                        name="deth_motivo_consulta"
                        id="deth_motivo_consulta"
                        rows="3"
                        required
                        placeholder="Describa el motivo principal de la consulta..."
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63] resize-none">{{ old('deth_motivo_consulta') }}</textarea>
                </div>

                <!-- Tratamientos Previos -->
                <div>
                    <x-input-label for="deth_tratamientos_previos" value="Tratamientos previos" class="text-gray-700" />
                    <textarea
                        name="deth_tratamientos_previos"
                        id="deth_tratamientos_previos"
                        rows="3"
                        placeholder="Indique tratamientos o medicamentos previos..."
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63] resize-none">{{ old('deth_tratamientos_previos') }}</textarea>
                </div>

                <!-- Medidas Antropométricas -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Medidas Antropométricas</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="deth_peso" value="Peso (kg) *" class="text-gray-700" />
                            <x-text-input
                                name="deth_peso"
                                id="deth_peso"
                                type="number"
                                step="0.10"
                                min="0"
                                max="300"
                                required
                                placeholder="0.0"
                                value="{{ old('deth_peso') }}"
                                class="mt-1 focus:ring-[#0b5d63] focus:border-[#0b5d63]" />
                        </div>
                        <div>
                            <x-input-label for="deth_talla" value="Talla (m) *" class="text-gray-700" />
                            <x-text-input
                                name="deth_talla"
                                id="deth_talla"
                                type="number"
                                step="0.01"
                                min="0.5"
                                max="2.5"
                                required
                                placeholder="0.00"
                                value="{{ old('deth_talla') }}"
                                class="mt-1 focus:ring-[#0b5d63] focus:border-[#0b5d63]" />
                        </div>
                        <div>
                            <x-input-label for="deth_imc" value="IMC (calculado)" class="text-gray-700" />
                            <x-text-input
                                name="deth_imc"
                                id="deth_imc"
                                type="number"
                                step="0.01"
                                readonly
                                placeholder="--"
                                class="mt-1 bg-gray-100 focus:ring-[#0b5d63] focus:border-[#0b5d63]" />
                            <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente</p>
                        </div>
                    </div>
                </div>

                <!-- Información Clínica -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Información Clínica</h4>

                    <div class="mb-6">
                        <x-input-label for="deth_lado_dolor" value="Lado de dolor" class="text-gray-700" />
                        <x-text-input
                            name="deth_lado_dolor"
                            id="deth_lado_dolor"
                            placeholder="Ej: Izquierdo, Derecho, Bilateral..."
                            value="{{ old('deth_lado_dolor') }}"
                            class="mt-1 focus:ring-[#0b5d63] focus:border-[#0b5d63]" />
                    </div>

                    <div>
                        <x-input-label for="deth_exploracion_fisica" value="Exploración física" class="text-gray-700" />
                        <textarea
                            name="deth_exploracion_fisica"
                            id="deth_exploracion_fisica"
                            rows="4"
                            placeholder="Describa los hallazgos de la exploración física..."
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63] resize-none">{{ old('deth_exploracion_fisica') }}</textarea>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                        <button
                            type="button"
                            onclick="window.history.back()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-primarycolor-logo text-white rounded-md hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 font-medium">
                            Guardar Detalle
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript para calcular IMC automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pesoInput = document.getElementById('deth_peso');
            const tallaInput = document.getElementById('deth_talla');
            const imcInput = document.getElementById('deth_imc');

            function calcularIMC() {
                const peso = parseFloat(pesoInput.value);
                const talla = parseFloat(tallaInput.value);

                if (peso && talla && talla > 0) {
                    const imc = peso / (talla * talla);
                    imcInput.value = imc.toFixed(2);

                    // Cambiar color del IMC según categoría
                    if (imc < 18.5) {
                        imcInput.className = imcInput.className.replace(/text-\w+-\d+/, '') + ' text-blue-600';
                    } else if (imc >= 18.5 && imc < 25) {
                        imcInput.className = imcInput.className.replace(/text-\w+-\d+/, '') + ' text-green-600';
                    } else if (imc >= 25 && imc < 30) {
                        imcInput.className = imcInput.className.replace(/text-\w+-\d+/, '') + ' text-yellow-600';
                    } else {
                        imcInput.className = imcInput.className.replace(/text-\w+-\d+/, '') + ' text-red-600';
                    }
                } else {
                    imcInput.value = '';
                    imcInput.className = imcInput.className.replace(/text-\w+-\d+/, '') + ' text-gray-900';
                }
            }

            // Calcular IMC al escribir
            pesoInput.addEventListener('input', calcularIMC);
            tallaInput.addEventListener('input', calcularIMC);

            // Calcular IMC si hay valores previos (old values)
            if (pesoInput.value && tallaInput.value) {
                calcularIMC();
            }
        });
    </script>
</x-app-layout>
