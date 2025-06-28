<x-app-layout>
    <x-slot name="header">Editar Promoción</x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('promociones.update', $promocion->prom_id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <x-input-label for="prom_nombre" value="Nombre" />
            <x-text-input name="prom_nombre" class="w-full" value="{{ $promocion->prom_nombre }}" required />

            <x-input-label for="prom_descripcion" value="Descripción" />
            <textarea name="prom_descripcion" class="w-full border-gray-300 rounded">{{ $promocion->prom_descripcion }}</textarea>

            <x-input-label for="prom_precio" value="Precio ($)" />
            <x-text-input name="prom_precio" type="number" step="0.01" class="w-full" value="{{ $promocion->prom_precio }}" required />

            <x-input-label for="prom_sesiones" value="Número de Sesiones" />
            <x-text-input name="prom_sesiones" type="number" class="w-full" value="{{ $promocion->prom_sesiones }}" required />

            <x-primary-button>Actualizar</x-primary-button>
        </form>
    </div>
</x-app-layout>
