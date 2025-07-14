<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Enfermedad Actual - Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('enfermedad_actual.store', $his_id) }}" class="space-y-6">
            @csrf

            <div id="enfermedades-container"></div>

            <button type="button" onclick="agregarEnfermedad()" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Añadir Enfermedad
            </button>

            <x-primary-button class="mt-4">Guardar Enfermedades</x-primary-button>
        </form>
    </div>

</x-app-layout>

<script>
    let contador = 0;

    function agregarEnfermedad() {
        const container = document.getElementById('enfermedades-container');
        const index = contador++;

        const div = document.createElement('div');
        div.className = 'p-4 border rounded mb-4 bg-gray-50';
        div.innerHTML = `
                <div class="mb-3">
                    <label class="block font-medium text-gray-700">Tipo de Enfermedad</label>
                    <select name="enfermedades[${index}][enf_tipo_id]" class="form-select w-full mt-1" required>
                        <option value="">-- Selecciona --</option>
                        @foreach ($tiposEnfermedad as $tipo)
                            <option value="{{ $tipo->tipo_enf_id }}">{{ $tipo->tipo_enf_nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Descripción</label>
                    <textarea name="enfermedades[${index}][enf_descripcion]" rows="3" class="form-textarea w-full mt-1" required></textarea>
                </div>
            `;

        container.appendChild(div);
    }

    window.onload = agregarEnfermedad;
</script>
