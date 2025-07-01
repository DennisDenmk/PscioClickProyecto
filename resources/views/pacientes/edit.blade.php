<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Editar Paciente</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
            <form method="POST" action="{{ route('pacientes.update', $paciente->pac_cedula) }}">
                @method('PUT')
                @csrf

                <x-paciente-form :paciente="$paciente" :estadosCiviles="$estadosCiviles" />

                <div class="mt-6 text-right">
                    <x-primary-button class="rounded-2xl px-6 py-2">
                        Actualizar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
