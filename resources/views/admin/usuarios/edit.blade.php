<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Vista de escritorio (lg y superiores) -->
            <div class="hidden lg:block">
                <div class="p-8">
                    <form method="POST" action="{{ route('usuarios.update', $user->cedula) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" value="Nombre" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    value="{{ old('name', $user->name) }}" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="apellido" value="Apellido" />
                                <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                                    value="{{ old('apellido', $user->apellido) }}" />
                                <x-input-error :messages="$errors->get('apellido')" />
                            </div>

                            <div>
                                <x-input-label for="cedula" value="Cédula" />
                                <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full" inputmode="numeric"
                                    pattern="[0-9]*" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ old('cedula', $user->cedula) }}" />
                                <x-input-error :messages="$errors->get('cedula')" />
                            </div>

                            <div>
                                <x-input-label for="telefono" value="Teléfono" />
                                <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ old('telefono', $user->telefono) }}" />
                                <x-input-error :messages="$errors->get('telefono')" />
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="email" value="Correo electrónico" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    value="{{ old('email', $user->email) }}" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="role_id" value="Rol" />
                                <select name="role_id" id="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}" {{ $user->role_id == $rol->id ? 'selected' : '' }}>
                                            {{ $rol->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role_id')" />
                            </div>

                            <div>
                                <x-input-label for="estado" value="Estado" />
                                <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" />
                            </div>
                        </div>

                        <div class="flex justify-end mt-8">
                            <a href="{{ route('usuarios.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded mr-4 transition duration-200">
                                Cancelar
                            </a>
                            <x-primary-button class="px-6 py-2">Actualizar Usuario</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista de tabletas (md a lg) -->
            <div class="hidden md:block lg:hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('usuarios.update', $user->cedula) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" value="Nombre" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                        value="{{ old('name', $user->name) }}" />
                                    <x-input-error :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="apellido" value="Apellido" />
                                    <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                                        value="{{ old('apellido', $user->apellido) }}" />
                                    <x-input-error :messages="$errors->get('apellido')" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="cedula" value="Cédula" />
                                    <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full" inputmode="numeric"
                                        pattern="[0-9]*" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        value="{{ old('cedula', $user->cedula) }}" />
                                    <x-input-error :messages="$errors->get('cedula')" />
                                </div>

                                <div>
                                    <x-input-label for="telefono" value="Teléfono" />
                                    <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full"
                                        inputmode="numeric" pattern="[0-9]*" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        value="{{ old('telefono', $user->telefono) }}" />
                                    <x-input-error :messages="$errors->get('telefono')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="email" value="Correo electrónico" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    value="{{ old('email', $user->email) }}" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="role_id" value="Rol" />
                                    <select name="role_id" id="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}" {{ $user->role_id == $rol->id ? 'selected' : '' }}>
                                                {{ $rol->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('role_id')" />
                                </div>

                                <div>
                                    <x-input-label for="estado" value="Estado" />
                                    <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('estado')" />
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                            <a href="{{ route('usuarios.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-center transition duration-200">
                                Cancelar
                            </a>
                            <x-primary-button class="px-6 py-2">Actualizar Usuario</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista móvil (sm y menores) -->
            <div class="block md:hidden">
                <div class="p-4">
                    <form method="POST" action="{{ route('usuarios.update', $user->cedula) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="name" value="Nombre" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    value="{{ old('name', $user->name) }}" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="apellido" value="Apellido" />
                                <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                                    value="{{ old('apellido', $user->apellido) }}" />
                                <x-input-error :messages="$errors->get('apellido')" />
                            </div>

                            <div>
                                <x-input-label for="cedula" value="Cédula" />
                                <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full" inputmode="numeric"
                                    pattern="[0-9]*" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ old('cedula', $user->cedula) }}" />
                                <x-input-error :messages="$errors->get('cedula')" />
                            </div>

                            <div>
                                <x-input-label for="telefono" value="Teléfono" />
                                <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ old('telefono', $user->telefono) }}" />
                                <x-input-error :messages="$errors->get('telefono')" />
                            </div>

                            <div>
                                <x-input-label for="email" value="Correo electrónico" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    value="{{ old('email', $user->email) }}" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="role_id" value="Rol" />
                                <select name="role_id" id="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}" {{ $user->role_id == $rol->id ? 'selected' : '' }}>
                                            {{ $rol->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role_id')" />
                            </div>

                            <div>
                                <x-input-label for="estado" value="Estado" />
                                <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 mt-6">
                            <x-primary-button class="w-full py-3">Actualizar Usuario</x-primary-button>
                            <a href="{{ route('usuarios.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded text-center transition duration-200">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
