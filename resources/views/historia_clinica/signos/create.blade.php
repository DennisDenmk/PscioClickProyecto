
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Signos Vitales</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form method="POST" action="{{ route('signos.store', $his_id) }}">
            @csrf

            <x-input-label for="sig_tension_arterial_sistolica" value="Tensión Arterial Sistólica" />
            <x-text-input name="sig_tension_arterial_sistolica" type="number" required />

            <x-input-label for="sig_tension_arterial_diastolica" value="Tensión Arterial Diastólica" />
            <x-text-input name="sig_tension_arterial_diastolica" type="number" required />

            <x-input-label for="sig_frecuencia_cardiaca" value="Frecuencia Cardíaca (lpm)" />
            <x-text-input name="sig_frecuencia_cardiaca" type="number" required />

            <x-input-label for="sig_frecuencia_respiratoria" value="Frecuencia Respiratoria (rpm)" />
            <x-text-input name="sig_frecuencia_respiratoria" type="number" required />

            <x-input-label for="sig_saturacion_oxigeno" value="Saturación de Oxígeno (%)" />
            <x-text-input name="sig_saturacion_oxigeno" type="number" step="0.1" required />

            <x-input-label for="sig_temperatura" value="Temperatura (°C)" />
            <x-text-input name="sig_temperatura" type="number" step="0.1" required />

            <x-primary-button class="mt-4">Guardar</x-primary-button>
        </form>
    </div>
</x-app-layout>