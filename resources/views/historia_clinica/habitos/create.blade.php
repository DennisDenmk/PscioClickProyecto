<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Añadir Hábitos a Historia Clínica #{{ $his_id }}
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
                <h3 class="text-lg font-medium text-gray-900">Registro de Hábitos</h3>
                <p class="text-sm text-gray-600 mt-1">Añade los hábitos del paciente. Puedes agregar múltiples hábitos usando el botón correspondiente.</p>
            </div>

            <form method="POST" action="{{ route('habitos.store', $his_id) }}" class="p-6">
                @csrf

                <!-- Contenedor de hábitos dinámicos -->
                <div id="habitos-container" class="space-y-4 mb-6">
                    <!-- Los hábitos se añadirán aquí dinámicamente -->
                </div>

                <!-- Mensaje cuando no hay hábitos -->
                <div id="mensaje-vacio" class="p-8 text-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50" style="display: none;">
                    <div class="text-gray-500 mb-2">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.712-3.714M14 40v-4a9.971 9.971 0 01.712-3.714M28 16a4 4 0 11-8 0 4 4 0 018 0zm-4 8a6 6 0 00-6 6v2h12v-2a6 6 0 00-6-6z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">No hay hábitos agregados</p>
                    <p class="text-sm text-gray-400 mt-1">Haz clic en "Añadir Hábito" para comenzar</p>
                </div>

                <!-- Botones de acción -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row gap-3 justify-between">
                        <button type="button"
                                onclick="agregarHabito()"
                                class="inline-flex items-center px-4 py-2 border border-primarycolor-logo text-primarycolor-logo bg-white rounded-md hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Añadir Hábito
                        </button>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="button"
                                    onclick="window.history.back()"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                                Cancelar
                            </button>
                            <button type="submit"
                                    id="boton-guardar"
                                    disabled
                                    class="px-4 py-2 bg-primarycolor-logo text-white rounded-md hover:bg-[#09494e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                                Guardar Hábitos
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let contador = 0;
        let totalHabitos = 0;

        function agregarHabito() {
            const container = document.getElementById('habitos-container');
            const index = contador++;
            totalHabitos++;

            const div = document.createElement('div');
            div.className = 'relative p-6 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200';
            div.setAttribute('data-index', index);

            div.innerHTML = `
                <!-- Botón eliminar -->
                <button type="button"
                        onclick="eliminarHabito(this)"
                        class="absolute top-3 right-3 w-8 h-8 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 flex items-center justify-center text-sm font-bold shadow-sm"
                        title="Eliminar hábito">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="pr-12">
                    <!-- Contador visual -->
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-primarycolor-logo text-white rounded-full flex items-center justify-center text-sm font-medium">
                            ${totalHabitos}
                        </div>
                        <h4 class="ml-3 text-md font-medium text-gray-900">Hábito ${totalHabitos}</h4>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <!-- Tipo de Hábito -->
                        <div>
                            <label for="habitos_${index}_tipo_hab_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Tipo de Hábito <span class="text-red-500">*</span>
                            </label>
                            <select name="habitos[${index}][tipo_hab_id]"
                                    id="habitos_${index}_tipo_hab_id"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63] text-sm"
                                    required>
                                <option value="">-- Selecciona un tipo de hábito --</option>
                                @foreach ($tiposHabitos as $tipo)
                                    <option value="{{ $tipo->tipo_hab_id }}">{{ $tipo->tipo_hab_nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Detalle -->
                        <div>
                            <label for="habitos_${index}_hab_detalle" class="block text-sm font-medium text-gray-700 mb-1">
                                Detalle del Hábito <span class="text-gray-400">(opcional)</span>
                            </label>
                            <textarea name="habitos[${index}][hab_detalle]"
                                      id="habitos_${index}_hab_detalle"
                                      rows="3"
                                      placeholder="Ej: frecuencia (diario, semanal), cantidad, horarios, observaciones especiales..."
                                      class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63] text-sm resize-none"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Proporciona detalles específicos que puedan ser relevantes para el tratamiento</p>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(div);
            actualizarEstadoFormulario();

            // Scroll suave hacia el nuevo elemento
            setTimeout(() => {
                div.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                // Focus en el select del nuevo hábito
                div.querySelector('select').focus();
            }, 100);
        }

        function eliminarHabito(boton) {
            // Confirmación antes de eliminar
            if (confirm('¿Estás seguro de que deseas eliminar este hábito?')) {
                const div = boton.closest('div[data-index]');
                div.style.transition = 'all 0.3s ease-out';
                div.style.transform = 'scale(0.95)';
                div.style.opacity = '0';

                setTimeout(() => {
                    div.remove();
                    totalHabitos--;
                    actualizarNumeracionHabitos();
                    actualizarEstadoFormulario();
                }, 300);
            }
        }

        function actualizarNumeracionHabitos() {
            const habitosContainer = document.getElementById('habitos-container');
            const habitos = habitosContainer.querySelectorAll('div[data-index]');

            habitos.forEach((habito, index) => {
                const contador = habito.querySelector('.bg-primarycolor-logo');
                const titulo = habito.querySelector('h4');
                if (contador && titulo) {
                    contador.textContent = index + 1;
                    titulo.textContent = `Hábito ${index + 1}`;
                }
            });
        }

        function actualizarEstadoFormulario() {
            const container = document.getElementById('habitos-container');
            const mensajeVacio = document.getElementById('mensaje-vacio');
            const botonGuardar = document.getElementById('boton-guardar');

            if (totalHabitos === 0) {
                mensajeVacio.style.display = 'block';
                botonGuardar.disabled = true;
            } else {
                mensajeVacio.style.display = 'none';
                botonGuardar.disabled = false;
            }
        }

        // Inicializar con un hábito al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            agregarHabito();
        });

        // Validación antes de enviar el formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const selects = document.querySelectorAll('select[name*="tipo_hab_id"]');
            let valid = true;

            selects.forEach(select => {
                if (!select.value) {
                    valid = false;
                    select.classList.add('border-red-500');
                } else {
                    select.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Por favor, selecciona un tipo de hábito para todos los campos obligatorios.');
                return false;
            }
        });
    </script>
</x-app-layout>
