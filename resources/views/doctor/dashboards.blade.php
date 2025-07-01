<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard de Doctor
            

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">Bienvenido, doctor</h3>
                <p class="mt-2 text-gray-600">Consulta tus pacientes, registra diagnósticos y accede a historias clínicas
                    desde aquí.</p>

                <a href="{{ route('historia_clinica.create') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                    Registrar Historia Clínica
                </a>
                <a href="{{ route('historia_clinica.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Ver Historias Clínicas
                </a>
                 <a href="{{ route('tipo_antecedente.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Tipo antecedentes
                </a>
                <a href="{{route('citas.calendario')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Calendario
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
