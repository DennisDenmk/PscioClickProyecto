<x-app-layout>
    <x-slot name="header">Crear Promoción</x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('promociones.store') }}" class="space-y-4">
            @csrf

            <x-input-label for="prom_nombre" value="Nombre" />
            <x-text-input name="prom_nombre" class="w-full" required />

            <x-input-label for="prom_descripcion" value="Descripción" />
            <textarea name="prom_descripcion" class="w-full border-gray-300 rounded"></textarea>

            <x-input-label for="prom_precio" value="Precio ($)" />
            <x-text-input name="prom_precio" type="number" step="0.01" class="w-full" required />

            <x-input-label for="prom_sesiones" value="Número de Sesiones" />
            <x-text-input name="prom_sesiones" type="number" class="w-full" required />

            <x-primary-button>Guardar</x-primary-button>
        </form>
    </div>
</x-app-layout>
