<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendario de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4 p-4 bg-white rounded shadow">
                    <h3 class="text-lg font-semibold mb-2">Leyenda de Estados</h3>

                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center">
                            <span class="w-4 h-4 inline-block bg-[#e19f25] mr-2 rounded"></span>
                            <span class="text-sm">Pendiente</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 inline-block bg-[#3440e5] mr-2 rounded"></span>
                            <span class="text-sm">Confirmada</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 inline-block bg-[#7bb899] mr-2 rounded"></span>
                            <span class="text-sm">Completada</span>
                        </div>
                    </div>
                </div>
                @rol('secretario')
                <div class="p-6 text-gray-900">
                    <a href="{{ route('citas.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Crear nueva cita</a>
                </div>
                @endrol
                <x-calendar/>
            </div>
        </div>
    </div>
</x-app-layout>
