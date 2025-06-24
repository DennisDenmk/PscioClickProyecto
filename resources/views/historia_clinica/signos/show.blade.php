<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalle de Signos Vitales</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white p-6 rounded shadow">
            <p><strong>Tensión Arterial:</strong> {{ $signo->sig_tension_arterial_sistolica }}/{{ $signo->sig_tension_arterial_diastolica }}</p>
            <p><strong>Frecuencia Cardíaca:</strong> {{ $signo->sig_frecuencia_cardiaca }} lpm</p>
            <p><strong>Frecuencia Respiratoria:</strong> {{ $signo->sig_frecuencia_respiratoria }} rpm</p>
            <p><strong>Saturación de Oxígeno:</strong> {{ $signo->sig_saturacion_oxigeno }}%</p>
            <p><strong>Temperatura:</strong> {{ $signo->sig_temperatura }} °C</p>
        </div>
    </div>
</x-app-layout>
