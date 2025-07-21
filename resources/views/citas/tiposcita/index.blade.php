<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tipos de Citas
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <!-- Botones de acción -->
            <!-- Botones de acción -->
<div class="flex flex-col sm:flex-row gap-3 justify-end">
    <a href="{{ route('tipocita.create') }}"
       class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
        + Añadir tipo
    </a>
    <a href="{{ route('citas.index') }}"
       class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
        Volver a Citas
    </a>
</div>


            <div class="bg-white shadow rounded-lg overflow-hidden">
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración (min)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tipos as $tipo)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tipo->tipc_nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tipo->tipc_duracion_minutos }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('tipocita.edit', $tipo->tipc_id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vista de tarjetas para pantallas medianas -->
                <div class="hidden md:block lg:hidden">
                    <div class="p-4 space-y-4">
                        @foreach($tipos as $tipo)
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Nombre del Tipo</div>
                                        <div class="text-sm text-gray-900">{{ $tipo->tipc_nombre }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Duración</div>
                                        <div class="text-sm text-gray-900">{{ $tipo->tipc_duracion_minutos }} minutos</div>
                                    </div>
                                    <div class="col-span-2 flex justify-start mt-3">
                                        <a href="{{ route('tipocita.edit', $tipo->tipc_id) }}"
                                            class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition duration-200">
                                            Editar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Vista compacta para móviles -->
                <div class="block md:hidden">
                    <div class="p-4 space-y-3">
                        @foreach($tipos as $tipo)
                            <div class="bg-gray-50 rounded-lg p-3 border">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $tipo->tipc_nombre }}</div>
                                        <div class="text-sm text-gray-600">{{ $tipo->tipc_duracion_minutos }} minutos</div>
                                    </div>
                                </div>

                                <div class="flex justify-start mt-3">
                                    <a href="{{ route('tipocita.edit', $tipo->tipc_id) }}"
                                        class="bg-indigo-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-indigo-700 transition duration-200">
                                        Editar Tipo
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
