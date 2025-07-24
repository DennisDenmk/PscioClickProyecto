<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Sesiones Activas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Usuario</th>
                            <th class="border p-2">IP</th>
                            <th class="border p-2">Agente</th>
                            <th class="border p-2">Última Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td class="border p-2">{{ $session->id }}</td>
                                <td class="border p-2">
                                    {{ $session->user ? $session->user->nombre : 'No autenticado' }}
                                </td>
                                <td class="border p-2">{{ $session->ip_address }}</td>
                                <td class="border p-2 truncate" title="{{ $session->user_agent }}">
                                    {{ Str::limit($session->user_agent, 30) }}
                                </td>
                                <td class="border p-2">
                                    {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($sessions->isEmpty())
                    <p class="text-center text-gray-500 mt-4">No hay sesiones registradas.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
