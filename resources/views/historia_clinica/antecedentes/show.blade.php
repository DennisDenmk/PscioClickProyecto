<x-app-layout>
    <div class="mt-10">
        <h3 class="text-lg font-semibold mb-4" style="color: #1a5555;">Antecedentes</h3>

        @if ($historia->antecedentes->isEmpty())
            <div class="text-center py-6 rounded-lg" style="background-color: #f8fcfa;">
                <p style="color: #2d7a6b;">No hay antecedentes registrados.</p>
            </div>
        @else
            <div class="overflow-x-auto rounded-lg shadow-sm border mb-4" style="border-color: #c8e6dc;">
                <table class="min-w-full divide-y" style="divide-color: #c8e6dc;">
                    <thead style="background: linear-gradient(135deg, #1a5555, #2d7a6b);">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-white">Tipo</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-white">Valor</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-white">Detalle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="background-color: white; divide-color: #c8e6dc;">
                        @foreach ($historia->antecedentes as $antecedente)
                            <tr class="hover:bg-opacity-50 transition-colors duration-150"
                                onmouseover="this.style.backgroundColor='#f8fcfa'"
                                onmouseout="this.style.backgroundColor='white'">
                                <td class="px-4 py-3 text-sm font-medium" style="color: #1a5555;">
                                    {{ $antecedente->tipoAntecedente->tipa_nombre }}
                                </td>
                                <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                    {{ $antecedente->ant_valor ? 'SI' : 'NO' }}
                                </td>

                                <td class="px-4 py-3 text-sm" style="color: #2d7a6b;">
                                    {{ $antecedente->ant_detalle ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
</x-app-layout>
