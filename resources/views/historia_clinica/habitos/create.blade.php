<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Registrar Hábitos para Historia Clínica #{{ $his_id }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10">
        <form method="POST" action="{{ route('habitos.store', $his_id) }}" class="space-y-6">
            @csrf

            <fieldset>
                <legend class="text-lg font-medium text-gray-700 mb-4">Selecciona los hábitos</legend>

                @foreach ($tiposHabitos as $tipo)
                    <div class="flex items-center mb-3">
                        <input 
                            type="checkbox" 
                            id="habito_{{ $tipo->tipo_hab_id }}" 
                            name="tipo_habitos[]" 
                            value="{{ $tipo->tipo_hab_id }}"
                            class="form-checkbox h-5 w-5 text-indigo-600"
                            @if( is_array(old('tipo_habitos')) && in_array($tipo->tipo_hab_id, old('tipo_habitos')) ) checked @endif
                        >
                        <label for="habito_{{ $tipo->tipo_hab_id }}" class="ml-3 block text-gray-700">
                            {{ $tipo->tipo_hab_nombre }}
                        </label>
                    </div>
                @endforeach

                <x-input-error :messages="$errors->get('tipo_habitos')" class="mt-2" />
            </fieldset>

            <x-primary-button>Guardar Hábitos</x-primary-button>
        </form>
    </div>
</x-app-layout>
