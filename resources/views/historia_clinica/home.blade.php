<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight" style="color: #1a5555;">
            Detalles de Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>
    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="mb-6 p-4 rounded-lg shadow-sm" style="background-color: #f8fcfa; border-left: 4px solid #2d7a6b;">
            <h3 class="text-lg font-bold mb-2" style="color: #1a5555;">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm" style="color: #2d7a6b;">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>
    </div>
    <div class="mb-6 flex flex-wrap gap-3">
        @rol('doctor')
            <a href="{{ route('historias.show', $historia->his_id) }}"
                class="px-4 py-2 rounded-md text-white font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                style="background-color: #2d7a6b; border: 1px solid #1a5555;"
                onmouseover="this.style.backgroundColor='#1a5555'" onmouseout="this.style.backgroundColor='#2d7a6b'">
                Consultas
            </a>

            <a href="{{ route('habitos.show', $historia->his_id) }}"
                class="px-4 py-2 rounded-md text-white font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                style="background-color: #7bb899; border: 1px solid #2d7a6b;"
                onmouseover="this.style.backgroundColor='#2d7a6b'" onmouseout="this.style.backgroundColor='#7bb899'">
                + Revisar Hábitos
            </a>

            <a href="{{ route('habitos.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md font-medium transition-colors duration-200 border-2"
                style="color: #1a5555; border-color: #7bb899; background-color: transparent;"
                onmouseover="this.style.backgroundColor='#c8e6dc'; this.style.borderColor='#2d7a6b'"
                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#7bb899'">
                Registrar Hábitos
            </a>
            <a href="{{ route('antecedentes.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md font-medium transition-colors duration-200 border-2"
                style="color: #1a5555; border-color: #7bb899; background-color: transparent;"
                onmouseover="this.style.backgroundColor='#c8e6dc'; this.style.borderColor='#2d7a6b'"
                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#7bb899'">
                Registrar Antecedentes
            </a>
            <a href="{{ route('antecedentes.show', $historia->his_id) }}"
                class="px-4 py-2 rounded-md font-medium transition-colors duration-200 border-2"
                style="color: #1a5555; border-color: #7bb899; background-color: transparent;"
                onmouseover="this.style.backgroundColor='#c8e6dc'; this.style.borderColor='#2d7a6b'"
                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#7bb899'">
                Mostrar Antecedentes
            </a>
            <a href="{{ route('enfermedad_actual.index', $historia->his_id) }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                Enfermedad-Actual
            </a>
            <a href="{{ route('plan_tratamiento.index', $historia->his_id) }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                Plan de tratamiento
            </a>
            <a href="{{ route('estado_reproductivo.index', $historia->his_id) }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                Estado Reproductivo
            </a>
            <a href="{{ route('evaluaciones.index', $historia->his_id) }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                Evaluaciones
            </a>
        @endrol

    </div>
</x-app-layout>
