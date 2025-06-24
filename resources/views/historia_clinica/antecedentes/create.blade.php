<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Registrar Antecedentes para Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <form method="POST" action="{{ route('antecedentes.store', $his_id) }}" class="space-y-6">
            @csrf

            @foreach($tiposAntecedentes as $tipo)
                <div>
                    <x-input-label for="antecedentes[{{ $tipo->tipa_id }}][ant_valor]" :value="$tipo->tipa_nombre" />
                    <select name="antecedentes[{{ $tipo->tipa_id }}][ant_valor]" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="No">No</option>
                        <option value="Sí">Sí</option>
                    </select>

                    <x-input-label value="Detalle (opcional)" class="mt-2" />
                    <x-text-input type="text" name="antecedentes[{{ $tipo->tipa_id }}][ant_detalle]" class="w-full" />
                </div>
            @endforeach

            <x-primary-button>Guardar Antecedentes</x-primary-button>
        </form>
    </div>
</x-app-layout>
