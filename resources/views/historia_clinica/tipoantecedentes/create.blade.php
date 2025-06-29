<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Crear Tipo de Antecedente</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('tipo_antecedente.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label value="Nombre del tipo" for="tipa_nombre" />
                <x-text-input name="tipa_nombre" class="w-full" value="{{ old('tipa_nombre') }}" />
                <x-input-error :messages="$errors->get('tipa_nombre')" />
            </div>

            <x-primary-button>Guardar</x-primary-button>
        </form>
    </div>
</x-app-layout>
