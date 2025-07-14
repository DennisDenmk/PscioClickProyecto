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

            <button type="button" onclick="agregarAntecedente()" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Añadir Antecedente
            </button>

            <x-primary-button class="mt-4">Guardar Antecedentes</x-primary-button>
        </form>
    </div>
</x-app-layout>
<script>
    let contador = 0;

    function agregarAntecedente() {
        const container = document.getElementById('antecedentes-container');
        const index = contador++;

        const div = document.createElement('div');
        div.className = 'p-4 border rounded mb-4 bg-gray-50';
        div.innerHTML = `
                <div class="mb-3">
                    <label for="antecedentes[${index}][tipo_ant_id]" class="block font-medium text-gray-700">Tipo de Antecedente</label>
                    <select name="antecedentes[${index}][tipo_ant_id]" required class="form-select w-full mt-1">
                        <option value="">-- Selecciona --</option>
                        @foreach ($tiposAntecedentes as $tipo)
                            <option value="{{ $tipo->tipa_id }}">{{ $tipo->tipa_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="antecedentes[${index}][ant_detalle]" class="block font-medium text-gray-700">Detalle (opcional)</label>
                    <textarea name="antecedentes[${index}][ant_detalle]" rows="2" class="form-textarea w-full mt-1" placeholder="Ej: años, observaciones..."></textarea>
                </div>
            `;

        container.appendChild(div);
    }

    window.onload = agregarAntecedente;
</script>
