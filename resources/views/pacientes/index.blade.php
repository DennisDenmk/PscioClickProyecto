<!-- resources/views/pacientes/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Pacientes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pacientes.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Nuevo Paciente
            </a>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Cédula</th>
                            <th class="border px-4 py-2">Nombres</th>
                            <th class="border px-4 py-2">Apellidos</th>
                            <th class="border px-4 py-2">Estado Civil</th>
                            <th class="border px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            <tr>
                                <td class="border px-4 py-2">{{ $paciente->pac_cedula }}</td>
                                <td class="border px-4 py-2">{{ $paciente->pac_nombres }}</td>
                                <td class="border px-4 py-2">{{ $paciente->pac_apellidos }}</td>
                                <td class="border px-4 py-2">{{ $paciente->estadoCivil->estc_nombre ?? 'Sin estado' }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('pacientes.show', $paciente->pac_cedula) }}" class="text-blue-600 hover:underline">Ver</a> |
                                    <a href="{{ route('pacientes.edit', $paciente->pac_cedula) }}" class="text-yellow-600 hover:underline">Editar</a> |
                                    <form action="{{ route('pacientes.destroy', $paciente->pac_cedula) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro?')" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($pacientes->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay pacientes registrados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
