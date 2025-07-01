<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Estados Civiles</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto px-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('estado_civil.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-300">
                + Nuevo
            </a>
        </div>

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-800">
            <table class="w-full min-w-[400px] divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Nombre</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($estados as $estado)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $estado->estc_id }}</td>
                            <td class="px-4 py-2">{{ $estado->estc_nombre }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('estado_civil.edit', $estado->estc_id) }}"
                                   class="text-blue-600 hover:underline dark:text-blue-400">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
