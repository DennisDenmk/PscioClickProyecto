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
                    Hábitos
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
                    Enfermedad Actual
                </a>
                <a href="{{ route('plan_tratamiento.index', $historia->his_id) }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Plan de Tratamiento
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

        {{-- Últimos Registros --}}
        <div class="container">
            <h1 class="mb-4">Resumen de Historia Clínica</h1>

            {{-- Información del paciente --}}
            <div class="card mb-4">
                <div class="card-header">Paciente</div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $historia->paciente->pac_nombres ?? 'No disponible' }}</p>
                    <p><strong>Cédula:</strong> {{ $historia->paciente->pac_cedula ?? 'No disponible' }}</p>
                </div>
            </div>

            {{-- Sección Hábitos --}}
            <div class="card mb-4">
                <div class="card-header">Último Hábito</div>
                <div class="card-body">
                    @if ($ultimoHabito)
                        <p><strong>Tipo:</strong> {{ $ultimoHabito->tipoHabito->tipo_hab_nombre ?? 'N/A' }}</p>
                        <p><strong>Detalle:</strong> {{ $ultimoHabito->hab_detalle }}</p>
                    @else
                        <p>No se han registrado hábitos.</p>
                    @endif
                </div>
            </div>

            {{-- Sección Antecedentes --}}
            <div class="card mb-4">
                <div class="card-header">Último Antecedente</div>
                <div class="card-body">
                    @if ($ultimoAntecedente)
                        <p><strong>Tipo:</strong> {{ $ultimoAntecedente->tipoAntecedente->tipo_ant_nombre ?? 'N/A' }}
                        </p>
                        <p><strong>Valor:</strong> {{ $ultimoAntecedente->ant_valor }}</p>
                        <p><strong>Detalle:</strong> {{ $ultimoAntecedente->ant_detalle }}</p>
                    @else
                        <p>No se han registrado antecedentes.</p>
                    @endif
                </div>
            </div>

            {{-- Sección Enfermedad Actual --}}
            <div class="card mb-4">
                <div class="card-header">Última Enfermedad Actual</div>
                <div class="card-body">
                    @if ($ultimaEnfermedadActual)
                        <p><strong>Motivo:</strong> {{ $ultimaEnfermedadActual->enf_motivo }}</p>
                        <p><strong>Tiempo:</strong> {{ $ultimaEnfermedadActual->enf_tiempo }}</p>
                        <p><strong>Frecuencia:</strong> {{ $ultimaEnfermedadActual->enf_frecuencia }}</p>
                        <p><strong>Intensidad:</strong> {{ $ultimaEnfermedadActual->enf_intensidad }}</p>
                        <p><strong>Localización:</strong> {{ $ultimaEnfermedadActual->enf_localizacion }}</p>
                        <p><strong>Observación:</strong> {{ $ultimaEnfermedadActual->enf_observacion }}</p>
                    @else
                        <p>No se han registrado enfermedades actuales.</p>
                    @endif
                </div>
            </div>

            {{-- Sección Estado Reproductivo --}}
            <div class="card mb-4">
                <div class="card-header">Estado Reproductivo</div>
                <div class="card-body">
                    @if ($ultimoEstadoReproductivo)
                        <p><strong>Menarquía:</strong> {{ $ultimoEstadoReproductivo->est_menarquia }}</p>
                        <p><strong>Menopausia:</strong> {{ $ultimoEstadoReproductivo->est_menopausia }}</p>
                        <p><strong>FUM:</strong> {{ $ultimoEstadoReproductivo->est_fum }}</p>
                        <p><strong>Observaciones:</strong> {{ $ultimoEstadoReproductivo->est_observacion }}</p>
                    @else
                        <p>No se ha registrado estado reproductivo.</p>
                    @endif
                </div>
            </div>

            {{-- Sección Evaluación --}}
            <div class="card mb-4">
                <div class="card-header">Última Evaluación</div>
                <div class="card-body">
                    @if ($ultimaEvaluacion)
                        <p><strong>Evaluación:</strong> {{ $ultimaEvaluacion->eva_descripcion }}</p>
                        <p><strong>Fecha:</strong> {{ $ultimaEvaluacion->created_at->format('d/m/Y H:i') }}</p>
                    @else
                        <p>No se ha registrado ninguna evaluación.</p>
                    @endif
                </div>
            </div>

            {{-- Sección Plan de Tratamiento --}}
            <div class="card mb-4">
                <div class="card-header">Último Plan de Tratamiento</div>
                <div class="card-body">
                    @if ($ultimoPlanTratamiento)
                        <p><strong>Diagnóstico:</strong> {{ $ultimoPlanTratamiento->pla_diagnostico }}</p>
                        <p><strong>Plan:</strong> {{ $ultimoPlanTratamiento->pla_plan }}</p>
                        <p><strong>Fecha:</strong> {{ $ultimoPlanTratamiento->created_at->format('d/m/Y H:i') }}</p>
                    @else
                        <p>No se ha registrado ningún plan de tratamiento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
