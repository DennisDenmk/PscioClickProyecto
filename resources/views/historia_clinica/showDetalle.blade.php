<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight" style="color: #1a5555;">
            Detalles de Historia Clínica #{{ $historia->his_id }}   
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <!-- Información del Paciente -->
        <div class="mb-6 p-4 rounded-lg shadow-sm" style="background-color: #f8fcfa; border-left: 4px solid #2d7a6b;">
            <h3 class="text-lg font-bold mb-2" style="color: #1a5555;">
                Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
            </h3>
            <p class="text-sm" style="color: #2d7a6b;">Cédula: {{ $historia->paciente->pac_cedula }}</p>
        </div>

        <!-- Botones de Acción -->
        <div class="mb-6 flex flex-wrap gap-3">
            @rol('doctor')
            <a href="{{ route('detalles.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md text-white font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                style="background-color: #2d7a6b; border: 1px solid #1a5555;"
                onmouseover="this.style.backgroundColor='#1a5555'" onmouseout="this.style.backgroundColor='#2d7a6b'">
                + Agregar Detalle
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
             <a href="{{ route('enfermedad_actual.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Enfermedad-Actual
            </a>
            <a href="{{ route('plan_tratamiento.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Plan de tratamiento
            </a>
            <a href="{{ route('estado_reproductivo.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Estado Reproductivo
            </a>
            <a href="{{ route('evaluaciones.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-back font-bold py-2 px-4 rounded mt-4">
                    Evaluaciones
            </a>
            @endrol
            
        </div>

        <!-- Tabla de Detalles -->
        @if ($historia->detallesHistoria->isEmpty())
            <div class="text-center py-8 rounded-lg" style="background-color: #f8fcfa;">
                <p style="color: #2d7a6b;">No hay detalles registrados.</p>
            </div>
        @else
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4" style="color: #1a5555;">Detalles de Consulta</h3>
                <div class="overflow-x-auto rounded-lg shadow-sm border" style="border-color: #c8e6dc;">
                    <table class="min-w-full divide-y" style="divide-color: #c8e6dc;">
                        <thead style="background-color: #2d7a6b;">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Fecha</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Motivo</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Peso</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Talla</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Fecha Creación</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="background-color: white; divide-color: #c8e6dc;">
                            @foreach ($historia->detallesHistoria as $detalle)
                                <tr class="hover:bg-opacity-50 transition-colors duration-150"
                                    onmouseover="this.style.backgroundColor='#f8fcfa'"
                                    onmouseout="this.style.backgroundColor='white'">
                                    <td class="px-4 py-3 text-sm" style="color: #1a5555;">
                                        {{ $detalle->deth_fecha_valoracion }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                        {{ $detalle->deth_motivo_consulta }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">{{ $detalle->deth_peso }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">{{ $detalle->deth_talla }}
                                    </td>
                                    <td class="px-4 py-3 text-sm" style="color: #1a5555;">
                                        {{ $detalle->created_at->format('d/m/Y') }}</td>


                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                                class="text-sm font-medium hover:underline transition-colors duration-150"
                                                style="color: #1a5555;" onmouseover="this.style.color='#2d7a6b'"
                                                onmouseout="this.style.color='#1a5555'">
                                                Editar
                                            </a>
                                            <span style="color: #c8e6dc;">|</span>
                                            <a href="{{ route('signos.create', $historia->his_id) }}"
                                                class="px-3 py-1 text-xs font-medium text-white rounded transition-colors duration-150"
                                                style="background-color: #7bb899;"
                                                onmouseover="this.style.backgroundColor='#2d7a6b'"
                                                onmouseout="this.style.backgroundColor='#7bb899'">
                                                + Signos Vitales
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabla de Signos Vitales -->
            <div>
                <h3 class="text-lg font-semibold mb-4" style="color: #1a5555;">Signos Vitales</h3>
                @if ($historia->signosVitales->isEmpty())
                    <div class="text-center py-6 rounded-lg" style="background-color: #f8fcfa;">
                        <p style="color: #2d7a6b;">No hay signos vitales registrados.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg shadow-sm border" style="border-color: #c8e6dc;">
                        <table class="min-w-full divide-y" style="divide-color: #c8e6dc;">
                            <thead style="background-color: #7bb899;">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">TA</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">FC</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">FR</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">SpO₂</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">Temp</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">Fecha Creación</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-white">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="background-color: white; divide-color: #c8e6dc;">
                                @foreach ($historia->signosVitales as $signo)
                                    <tr class="hover:bg-opacity-50 transition-colors duration-150"
                                        onmouseover="this.style.backgroundColor='#f8fcfa'"
                                        onmouseout="this.style.backgroundColor='white'">
                                        <td class="px-4 py-3 text-sm font-medium" style="color: #1a5555;">
                                            {{ $signo->sig_tension_arterial_sistolica }}/{{ $signo->sig_tension_arterial_diastolica }}
                                        </td>
                                        <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                            {{ $signo->sig_frecuencia_cardiaca }}</td>
                                        <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                            {{ $signo->sig_frecuencia_respiratoria }}</td>
                                        <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                            {{ $signo->sig_saturacion_oxigeno }}%</td>
                                        <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                            {{ $signo->sig_temperatura }}°C</td>
                                        <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                            {{ $signo->created_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('signos.edit', $signo->sig_id) }}"
                                                class="text-sm font-medium hover:underline transition-colors duration-150"
                                                style="color: #1a5555;" onmouseover="this.style.color='#2d7a6b'"
                                                onmouseout="this.style.color='#1a5555'">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
