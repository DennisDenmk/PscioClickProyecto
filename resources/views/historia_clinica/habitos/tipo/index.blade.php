<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tipos de Hábito
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón "Nuevo Tipo" -->
        <div class="mb-6">
            <a href="{{ route('tipo_habito.create') }}"
               class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                + Nuevo Tipo
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            @if ($tipos->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No hay tipos de hábito registrados.
                </div>
            @else
                <!-- Vista de tabla para pantallas grandes -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tipos as $tipo)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tipo->tipo_hab_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tipo->tipo_hab_nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <a href="{{ route('tipo_habito.edit', $tipo->tipo_hab_id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vista de tarjetas para pantallas pequeñas y medianas -->
                <div class="block lg:hidden">
                    <div class="p-4 space-y-4">
                        @foreach($tipos as $tipo)
                            <!-- Vista de tarjeta para tablets -->
                            <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">ID</div>
                                        <div class="text-sm text-gray-900">{{ $tipo->tipo_hab_id }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-500">Nombre</div>
                                        <div class="text-sm text-gray-900">{{ $tipo->tipo_hab_nombre }}</div>
                                    </div>
                                    <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                        <a href="{{ route('tipo_habito.edit', $tipo->tipo_hab_id) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                            Editar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Vista compacta para móviles -->
                            <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">{{ $tipo->tipo_hab_nombre }}</div>
                                        <div class="text-sm text-gray-600">ID: {{ $tipo->tipo_hab_id }}</div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-2 mt-3">
                                    <a href="{{ route('tipo_habito.edit', $tipo->tipo_hab_id) }}"
                                        class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200 flex-1">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
