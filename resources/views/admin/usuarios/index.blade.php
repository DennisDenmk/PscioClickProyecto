<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Usuarios
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Vista de tabla para pantallas grandes -->
            <div class="hidden lg:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contraseña</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->apellido }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->cedula }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->role->nombre ?? 'Sin Rol' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full text-white {{ $user->estado ? 'bg-green-600' : 'bg-red-600' }}">
                                            {{ $user->estado ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if (auth()->user()->cedula !== $user->cedula)
                                            <a href="{{ route('usuarios.edit', $user->cedula) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium">
                                                Editar
                                            </a>
                                        @else
                                            <span class="text-gray-500">Cuenta Actual</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('usuarios.reset-password', $user->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de restablecer la contraseña a la cédula?');">
                                            @csrf
                                            <button type="submit"
                                                class="text-xs text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded transition duration-200">
                                                Restablecer
                                            </button>
                                        </form>
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
                    @foreach ($users as $user)
                        <div class="bg-gray-50 rounded-lg p-4 border">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">ID</div>
                                    <div class="text-sm text-gray-900">{{ $user->id }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Estado</div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full text-white {{ $user->estado ? 'bg-green-600' : 'bg-red-600' }}">
                                        {{ $user->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Nombre Completo</div>
                                    <div class="text-sm text-gray-900">{{ $user->name }} {{ $user->apellido }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Cédula</div>
                                    <div class="text-sm text-gray-900">{{ $user->cedula }}</div>
                                </div>
                                <div class="col-span-2">
                                    <div class="text-sm font-medium text-gray-500">Email</div>
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Rol</div>
                                    <div class="text-sm text-gray-900">{{ $user->role->nombre ?? 'Sin Rol' }}</div>
                                </div>
                                <div class="col-span-2 flex flex-wrap gap-2 mt-3">
                                    @if (auth()->user()->cedula !== $user->cedula)
                                        <a href="{{ route('usuarios.edit', $user->cedula) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-200">
                                            Editar
                                        </a>
                                    @else
                                        <span class="bg-gray-400 text-white px-3 py-1 rounded text-sm">Cuenta Actual</span>
                                    @endif
                                    <form action="{{ route('usuarios.reset-password', $user->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Estás seguro de restablecer la contraseña a la cédula?');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition duration-200">
                                            Restablecer Contraseña
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Vista compacta para móviles -->
            <div class="block md:hidden">
                <div class="p-4 space-y-3">
                    @foreach ($users as $user)
                        <div class="bg-gray-50 rounded-lg p-3 border">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $user->name }} {{ $user->apellido }}</div>
                                    <div class="text-sm text-gray-600">ID: {{ $user->id }}</div>
                                </div>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full text-white {{ $user->estado ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $user->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>

                            <div class="space-y-1 text-sm text-gray-600 mb-3">
                                <div><span class="font-medium">Cédula:</span> {{ $user->cedula }}</div>
                                <div><span class="font-medium">Email:</span> {{ $user->email }}</div>
                                <div><span class="font-medium">Rol:</span> {{ $user->role->nombre ?? 'Sin Rol' }}</div>
                            </div>

                            <div class="flex flex-col gap-2">
                                @if (auth()->user()->cedula !== $user->cedula)
                                    <a href="{{ route('usuarios.edit', $user->cedula) }}"
                                        class="bg-blue-600 text-white px-3 py-2 rounded text-sm text-center hover:bg-blue-700 transition duration-200">
                                        Editar Usuario
                                    </a>
                                @else
                                    <div class="bg-gray-400 text-white px-3 py-2 rounded text-sm text-center">
                                        Cuenta Actual
                                    </div>
                                @endif
                                <form action="{{ route('usuarios.reset-password', $user->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de restablecer la contraseña a la cédula?');">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-red-600 text-white px-3 py-2 rounded text-sm hover:bg-red-700 transition duration-200">
                                        Restablecer Contraseña
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
