<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Añadir Hábitos a Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('habitos.store', $his_id) }}" class="space-y-6">
            @csrf

            <div id="habitos-container">
                <!-- Bloques dinámicos de hábitos aparecerán aquí -->
            </div>

            <button type="button" onclick="agregarHabito()" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Añadir Hábito
            </button>

            <x-primary-button class="mt-4">Guardar Hábitos</x-primary-button>
        </form>
    </div>

   
</x-app-layout>
 <script>
        let contador = 0;

        function agregarHabito() {
            const container = document.getElementById('habitos-container');
            const index = contador++;

            const div = document.createElement('div');
            div.className = 'p-4 border rounded mb-4 bg-gray-50';
            div.innerHTML = `
                <div class="mb-3">
                    <label for="habitos[${index}][tipo_hab_id]" class="block font-medium text-gray-700">Tipo de Hábito</label>
                    <select name="habitos[${index}][tipo_hab_id]" class="form-select w-full mt-1" required>
                        <option value="">-- Selecciona --</option>
                        @foreach ($tiposHabitos as $tipo)
                            <option value="{{ $tipo->tipo_hab_id }}">{{ $tipo->tipo_hab_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="habitos[${index}][hab_detalle]" class="block font-medium text-gray-700">Detalle</label>
                    <textarea name="habitos[${index}][hab_detalle]" rows="2" class="form-textarea w-full mt-1" placeholder="Opcional..."></textarea>
                </div>
            `;

            container.appendChild(div);
        }

        // Agrega al menos un campo al cargar la página
        window.onload = agregarHabito;
    </script>