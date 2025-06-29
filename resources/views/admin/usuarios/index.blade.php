<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Usuarios
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nombre</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Apellido</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Cédula</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Rol</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Estado</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Acciones</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Restablecer Contraseña</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->apellido }}</td>
                            <td class="px-4 py-2">{{ $user->cedula }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->role->nombre ?? 'Sin Rol' }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded text-white {{ $user->estado ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $user->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{-- Comprobar si la cédula del usuario en la fila es diferente a la del usuario logueado --}}
                                @if (auth()->user()->cedula !== $user->cedula)
                                    <a href="{{ route('usuarios.edit', $user->cedula) }}"
                                        class="text-blue-600 hover:underline">
                                        Editar
                                    </a>
                                @else
                                    Cuenta Actual
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('usuarios.reset-password', $user->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de restablecer la contraseña a la cédula?');">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded">
                                        Restablecer Contraseña
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
