<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight" style="color: #1a5555;">
            Detalles de Historia Clínica #{{ $historia->his_id }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <div>
            <div class="mb-6 p-4 rounded-lg shadow-sm" style="background-color: #f8fcfa; border-left: 4px solid #2d7a6b;">
                <h3 class="text-lg font-bold mb-2" style="color: #1a5555;">
                    Paciente: {{ $historia->paciente->pac_nombres }} {{ $historia->paciente->pac_apellidos }}
                </h3>
                <p class="text-sm" style="color: #2d7a6b;">Cédula: {{ $historia->paciente->pac_cedula }}</p>
            </div>
        </div>
        <div class="py-10 max-w-7xl mx-auto px-4">
            <a href="{{ route('detalles.create', $historia->his_id) }}"
                class="px-4 py-2 rounded-md text-white font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                style="background-color: #2d7a6b; border: 1px solid #1a5555;"
                onmouseover="this.style.backgroundColor='#1a5555'" onmouseout="this.style.backgroundColor='#2d7a6b'">
                Crear Nueva Consulta
            </a>
        </div>

        <!-- Tabla de Detalles -->
        @if ($detalles->isEmpty())
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
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Motivo</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Peso</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Talla</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Fecha Toma de datos</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="background-color: white; divide-color: #c8e6dc;">
                            @foreach ($detalles as $detalle)
                                <tr class="hover:bg-opacity-50 transition-colors duration-150"
                                    onmouseover="this.style.backgroundColor='#f8fcfa'"
                                    onmouseout="this.style.backgroundColor='white'">
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                        {{ $detalle->deth_motivo_consulta }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">{{ $detalle->deth_peso }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">{{ $detalle->deth_talla }}</td>
                                    <td class="px-4 py-3 text-sm" style="color: #1a5555;">
                                        {{ $detalle->deth_fecha_valoracion }}</td>

                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('detalles.edit', $detalle->deth_id) }}"
                                                class="text-sm font-medium hover:underline transition-colors duration-150"
                                                style="color: #1a5555;" onmouseover="this.style.color='#2d7a6b'"
                                                onmouseout="this.style.color='#1a5555'">
                                                Editar
                                            </a>
                                            <span style="color: #c8e6dc;">|</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enlaces de paginación -->
                <div class="mt-4">
                    {{ $detalles->links('custom-pagination') }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
