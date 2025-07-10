<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard de Secretario
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
        $acciones = [
        ['ruta' => 'pacientes.create', 'texto' => 'Registrar Paciente', 'icono' => '📝', 'color' => 'purple'],
        ['ruta' => 'pacientes.index', 'texto' => 'Ver Pacientes', 'icono' => '👤', 'color' => 'green'],
        ['ruta' => 'citas.index', 'texto' => 'Agendar Cita', 'icono' => '📅', 'color' => 'yellow'],
        ['ruta' => 'tipocita.index', 'texto' => 'Tipo de Cita', 'icono' => '🗂️', 'color' => 'blue'],
        ['ruta' => 'promociones.index', 'texto' => 'Promociones', 'icono' => '🏷️', 'color' => 'pink'],
        ['ruta' => 'promocioncita.index', 'texto' => 'Promociones-Citas', 'icono' => '💬', 'color' => 'teal'],
        ['ruta' => 'estado_civil.index', 'texto' => 'Estado Civil', 'icono' => '❤️', 'color' => 'orange'],
        ['ruta' => 'citas.calendario', 'texto' => 'Calendario', 'icono' => '📆', 'color' => 'cyan'],
        ];
        @endphp

        @foreach ($acciones as $accion)
        @php
        $from = "from-{$accion['color']}-100";
        $to = "to-{$accion['color']}-200";
        $darkFrom = "dark:from-{$accion['color']}-900";
        $darkTo = "dark:to-{$accion['color']}-800";
        $textTitle = "text-{$accion['color']}-900 dark:text-white";
        $textNumber = "text-{$accion['color']}-800 dark:text-{$accion['color']}-200";
        $iconColor = "text-{$accion['color']}-700 dark:text-{$accion['color']}-300";
        @endphp

        <a href="{{ route($accion['ruta']) }}"
            class="block rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700
              bg-gradient-to-r {{ $from }} {{ $to }} {{ $darkFrom }} {{ $darkTo }}
              text-center cursor-pointer
              hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out">
            <div class="text-5xl mb-3 {{ $iconColor }} transition-transform group-hover:scale-110">
                {{ $accion['icono'] }}
            </div>
            <div class="text-lg font-semibold {{ $textTitle }}">
                {{ $accion['texto'] }}
            </div>
        </a>
        @endforeach
    </div>



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
                            <span class="w-4 h-4 inline-block bg-[#f53131] mr-2 rounded opacity-70"
                                style="text-decoration: line-through;"></span>
                            <span class="text-sm">Cancelada</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 inline-block bg-[#7bb899] mr-2 rounded"></span>
                            <span class="text-sm">Completada</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <x-calendar route="citas.calendario" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>