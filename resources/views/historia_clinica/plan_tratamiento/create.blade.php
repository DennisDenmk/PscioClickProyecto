<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Planes de Tratamiento - Historia Clínica #{{ $historia->pac_id}}
        </h2>
        <form method="POST" action="{{ route('plan_tratamiento.store', $historia->his_id) }}" class="space-y-6">

            @csrf

            <div class="mb-3">
                <label class="block font-medium text-gray-700">Diagnóstico</label>
                <input type="text" name="pla_diagnostico" class="form-input w-full mt-1" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium text-gray-700">Objetivo del Tratamiento</label>
                <textarea name="pla_objetivo_tratamiento" rows="2" class="form-textarea w-full mt-1" required></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Tratamiento</label>
                <textarea name="pla_tratamiento" rows="3" class="form-textarea w-full mt-1" required></textarea>
            </div>

            <x-primary-button class="mt-4">Guardar Plan</x-primary-button>
        </form>
    </div>
</x-app-layout>
