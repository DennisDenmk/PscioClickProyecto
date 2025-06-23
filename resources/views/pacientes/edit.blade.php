<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Editar Paciente</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('pacientes.update', $paciente->pac_cedula) }}">
            @method('PUT')
            <x-paciente-form :paciente="$paciente" :estadosCiviles="$estadosCiviles" />
            <div class="mt-4">
                <x-primary-button>Actualizar</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
