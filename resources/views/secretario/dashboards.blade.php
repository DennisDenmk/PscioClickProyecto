<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard de Secretario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">Bienvenido, secretario</h3>
                <p class="mt-2 text-gray-600">Desde aquí puedes agendar citas, verificar disponibilidad y gestionar los datos de los pacientes.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Registrar Paciente -->
                <a href="{{ route('pacientes.create') }}"
                   class="block bg-blue-100 hover:bg-blue-200 border border-blue-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Registrar Paciente
                </a>

                <!-- Ver Pacientes -->
                <a href="{{ route('pacientes.index') }}"
                   class="block bg-green-100 hover:bg-green-200 border border-green-400 text-green-800 font-semibold rounded-lg p-6 shadow text-center">
                    Ver Pacientes
                </a>

                <!-- Agendar Cita -->
                <a href="{{route('citas.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-yellow-800 font-semibold rounded-lg p-6 shadow text-center">
                    Agendar Cita
                </a>
                <a href="{{route('tipocita.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Tipo de cita
                </a>
                <a href="{{route('promociones.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Promociones
                </a>
                <a href="{{route('promocioncita.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Promociones-Citas
                </a>
                <a href="{{route('estado_civil.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    EstadoCivil
                </a>
                 <a href="{{route('horarios_doctor.index')}}"
                   class="block bg-yellow-100 hover:bg-yellow-200 border border-yellow-400 text-blue-800 font-semibold rounded-lg p-6 shadow text-center">
                    Horarios Doctor
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
