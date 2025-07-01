<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Editar Tipo de Cita
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
            <form method="POST" action="{{ route('tipocita.update', $tipo->tipc_id) }}">
                @csrf
                @method('PUT')

                <x-input-label for="tipc_nombre" value="Nombre" />
                <x-text-input id="tipc_nombre" name="tipc_nombre" value="{{ old('tipc_nombre', $tipo->tipc_nombre) }}" required class="w-full" />

                <x-input-label for="tipc_duracion_minutos" value="Duración en minutos" class="mt-4" />
                <x-text-input id="tipc_duracion_minutos" name="tipc_duracion_minutos" type="number" value="{{ old('tipc_duracion_minutos', $tipo->tipc_duracion_minutos) }}" required class="w-full" />

                <button
                    type="submit"
                    class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow transition duration-300"
                >
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
