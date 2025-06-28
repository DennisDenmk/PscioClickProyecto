<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Editar Tipo de Cita
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10">
        <form method="POST" action="{{ route('tipocita.update', $tipo->tipc_id) }}">
            @csrf
            @method('PUT')

            <x-input-label for="tipc_nombre" value="Nombre" />
            <x-text-input id="tipc_nombre" name="tipc_nombre" value="{{ old('tipc_nombre', $tipo->tipc_nombre) }}" required class="w-full" />

            <x-input-label for="tipc_duracion_minutos" value="Duración en minutos" class="mt-4" />
            <x-text-input id="tipc_duracion_minutos" name="tipc_duracion_minutos" type="number" value="{{ old('tipc_duracion_minutos', $tipo->tipc_duracion_minutos) }}" required class="w-full" />

            <x-primary-button class="mt-4">Actualizar</x-primary-button>
        </form>
    </div>
</x-app-layout>
