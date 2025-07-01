<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Registrar Paciente
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ route('pacientes.store') }}" class="space-y-6">
            <x-paciente-form :estadosCiviles="$estadosCiviles" />

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition duration-300">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
