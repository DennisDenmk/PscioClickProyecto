<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Estados Civiles
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón nuevo -->
        <div class="mb-6 flex justify-end">
            <a href="{{ route('estado_civil.create') }}"
               class="inline-flex items-center justify-center bg-primarycolor-logo hover:bg-[#09494e] text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
                + Nuevo Estado Civil
            </a>
        </div>


        <div class="bg-white shadow rounded-lg overflow-hidden">
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
                            @foreach ($estados as $estado)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estado->estc_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $estado->estc_nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <a href="{{ route('estado_civil.edit', $estado->estc_id) }}"
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
                    @foreach ($estados as $estado)
                        <!-- Vista de tarjeta para tablets -->
                        <div class="bg-gray-50 rounded-lg p-4 border hidden md:block">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">ID</div>
                                    <div class="text-sm text-gray-900">{{ $estado->estc_id }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Nombre</div>
                                    <div class="text-sm text-gray-900">{{ $estado->estc_nombre }}</div>
                                </div>
                                <div class="col-span-2 flex justify-end mt-3">
                                    <a href="{{ route('estado_civil.edit', $estado->estc_id) }}"
                                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Vista compacta para móviles -->
                        <div class="bg-gray-50 rounded-lg p-3 border block md:hidden">
                            <div class="flex justify-between items-center mb-3">
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $estado->estc_nombre }}</div>
                                    <div class="text-sm text-gray-600">ID: {{ $estado->estc_id }}</div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('estado_civil.edit', $estado->estc_id) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200">
                                    Editar Estado
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
