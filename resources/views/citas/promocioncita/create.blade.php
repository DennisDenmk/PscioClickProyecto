<x-app-layout>
    <x-slot name="header">Registrar Promoción de Cita</x-slot>

    <form action="{{ route('promocioncita.store') }}" method="POST" class="max-w-xl mx-auto mt-6 space-y-4">
        @csrf

        <label>Cita</label>
        <select name="cit_id" class="w-full border-gray-300 rounded">
            @foreach($citas as $cita)
                <option value="{{ $cita->cit_id }}">{{ $cita->cit_id }}</option>
            @endforeach
        </select>

        <label>Promoción</label>
        <select name="proc_id" class="w-full border-gray-300 rounded">
            @foreach($promociones as $promo)
                <option value="{{ $promo->prom_id }}">{{ $promo->prom_nombre }}</option>
            @endforeach
        </select>

        <label>Sesiones Usadas</label>
        <input type="number" name="proc_sesiones_usadas" min="0" class="w-full border-gray-300 rounded" required>

        <x-primary-button>Guardar</x-primary-button>
    </form>
</x-app-layout>
