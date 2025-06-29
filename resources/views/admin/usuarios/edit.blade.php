<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto px-4">
        <form method="POST" action="{{ route('usuarios.update', $user->cedula) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" value="Nombre" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    value="{{ old('name', $user->name) }}" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="mb-4">
                <x-input-label for="cedula" value="Cédula" />
                <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full"
                    value="{{ old('cedula', $user->cedula) }}" />
                <x-input-error :messages="$errors->get('cedula')" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" value="Correo electrónico" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    value="{{ old('email', $user->email) }}" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="mb-4">
                <x-input-label for="role_id" value="Rol" />
                <select name="role_id" id="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}" {{ $user->role_id == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role_id')" />
            </div>

            <div class="mb-4">
                <x-input-label for="estado" value="Estado" />
                <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
                </select>
                <x-input-error :messages="$errors->get('estado')" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>Actualizar Usuario</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
