<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Registrar Plan de Tratamiento - Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium bg-green-100 border border-green-300 px-4 py-2 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Información del Paciente -->
        <div class="mb-6 p-6 bg-green-50 rounded-lg shadow-sm border-l-4 border-primarycolor-logo">
            <h3 class="text-lg font-bold mb-2 text-[#0b5d63]">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm text-gray-600">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('plan_tratamiento.store', $historia->his_id) }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico</label>
                    <input type="text" name="pla_diagnostico" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63]" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Objetivo del Tratamiento</label>
                    <textarea name="pla_objetivo_tratamiento" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63]" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tratamiento</label>
                    <textarea name="pla_tratamiento" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#0b5d63] focus:border-[#0b5d63]" required></textarea>
                </div>

                <div class="pt-4">
                    <x-primary-button class="bg-primarycolor-logo hover:bg-[#09494e] text-white shadow-sm hover:shadow-md">
                        Guardar Plan
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Botón de navegación -->
        <div class="mt-6">
            <a href="{{ route('plan_tratamiento.index', $historia->his_id) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0b5d63] transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Planes de Tratamiento
            </a>
        </div>
    </div>
</x-app-layout>
