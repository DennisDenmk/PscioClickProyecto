<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Registrar Paciente</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('pacientes.store') }}">
            <x-paciente-form :estadosCiviles="$estadosCiviles" />
            <div class="mt-4">
                <x-primary-button>Guardar</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
