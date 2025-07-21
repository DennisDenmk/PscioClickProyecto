<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Añadir Antecedentes - Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('antecedentes.store', $his_id) }}" class="space-y-6">
            @csrf

            <div id="antecedentes-container"></div>

            <!-- Mensaje cuando no hay antecedentes -->
            <div id="mensaje-vacio" class="p-4 text-center text-gray-500 border-2 border-dashed border-gray-300 rounded" style="display: none;">
                No hay antecedentes agregados. Haz clic en el botón para añadir uno.
            </div>

            <div class="flex gap-4">
                <button type="button" onclick="agregarAntecedente()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                    + Añadir Antecedente
                </button>

                <x-primary-button class="disabled:opacity-50" id="boton-guardar" disabled>
                    Guardar Antecedentes
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        let contador = 0;
        let totalAntecedentes = 0;

        function agregarAntecedente() {
            const container = document.getElementById('antecedentes-container');
            const index = contador++;
            totalAntecedentes++;

            const div = document.createElement('div');
            div.className = 'p-4 border rounded mb-4 bg-gray-50 relative';
            div.setAttribute('data-index', index);
            div.innerHTML = `
                <!-- Botón eliminar -->
                <button type="button"
                        onclick="eliminarAntecedente(this)"
                        class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-full hover:bg-red-600 transition duration-200 flex items-center justify-center text-sm font-bold"
                        title="Eliminar antecedente">
                    ×
                </button>

                <div class="pr-10"> <!-- Padding right para evitar overlap con botón eliminar -->
                    <div class="mb-3">
                        <label for="antecedentes[${index}][tipo_ant_id]" class="block font-medium text-gray-700">
                            Tipo de Antecedente <span class="text-red-500">*</span>
                        </label>
                        <select name="antecedentes[${index}][tipo_ant_id]"
                                required
                                class="form-select w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Selecciona un tipo --</option>
                            @foreach ($tiposAntecedentes as $tipo)
                                <option value="{{ $tipo->tipa_id }}">{{ $tipo->tipa_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="antecedentes[${index}][ant_detalle]" class="block font-medium text-gray-700">
                            Detalle (opcional)
                        </label>
                        <textarea name="antecedentes[${index}][ant_detalle]"
                                  rows="2"
                                  class="form-textarea w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Ej: años, observaciones, medicamentos..."></textarea>
                    </div>
                </div>
            `;

            container.appendChild(div);
            actualizarEstadoFormulario();

            // Scroll suave hacia el nuevo elemento
            setTimeout(() => {
                div.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        function eliminarAntecedente(boton) {
            // Confirmación antes de eliminar
            if (confirm('¿Estás seguro de que deseas eliminar este antecedente?')) {
                const div = boton.closest('div[data-index]');
                div.remove();
                totalAntecedentes--;
                actualizarEstadoFormulario();
            }
        }

        function actualizarEstadoFormulario() {
            const container = document.getElementById('antecedentes-container');
            const mensajeVacio = document.getElementById('mensaje-vacio');
            const botonGuardar = document.getElementById('boton-guardar');

            if (totalAntecedentes === 0) {
                mensajeVacio.style.display = 'block';
                botonGuardar.disabled = true;
                botonGuardar.classList.add('opacity-50');
            } else {
                mensajeVacio.style.display = 'none';
                botonGuardar.disabled = false;
                botonGuardar.classList.remove('opacity-50');
            }
        }

        // Inicializar con un antecedente
        window.onload = function() {
            agregarAntecedente();
        };
    </script>

    <style>
        .form-select, .form-textarea {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
        }

        .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
    </style>
</x-app-layout>
