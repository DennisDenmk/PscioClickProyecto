<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Nuevo Estado Civil</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto px-4">
        <form method="POST" action="{{ route('estado_civil.store') }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-4">
            @csrf

            <div>
                <label for="estc_nombre" class="block font-medium text-gray-700 dark:text-gray-200">Nombre</label>
                <input type="text" name="estc_nombre" id="estc_nombre"
                       class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500"
                       required>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition duration-300">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
