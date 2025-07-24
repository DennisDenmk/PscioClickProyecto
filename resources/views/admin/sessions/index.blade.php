<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Sesiones Activas
        </h2>
    </x-slot>

    <div class="py-6">
         <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#09494e] uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Usuario
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#09494e] uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    Dirección IP
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#09494e] uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Agente Usuario
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#09494e] uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Última Actividad
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($sessions as $session)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($session->user)
                                                <div class="h-10 w-10 rounded-full bg-[#09494e] flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">
                                                        {{ substr($session->user->cedula, -2) }}
                                                    </span>
                                                </div>
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">?</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium {{ $session->user ? 'text-gray-900' : 'text-gray-500' }}">
                                                {{ $session->user ? $session->user->cedula : 'No autenticado' }}
                                            </div>
                                            <div class="text-sm {{ $session->user ? 'text-gray-500' : 'text-gray-400' }}">
                                                {{ $session->user ? 'Autenticado' : 'Sesión anónima' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $session->ip_address }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $session->user_agent }}">
                                        {{ Str::limit($session->user_agent, 30) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        @if(str_contains($session->user_agent, 'Chrome'))
                                            Chrome
                                        @elseif(str_contains($session->user_agent, 'Firefox'))
                                            Firefox
                                        @elseif(str_contains($session->user_agent, 'Safari'))
                                            Safari
                                        @else
                                            Navegador
                                        @endif
                                        -
                                        @if(str_contains($session->user_agent, 'Windows'))
                                            Windows
                                        @elseif(str_contains($session->user_agent, 'Mac'))
                                            macOS
                                        @elseif(str_contains($session->user_agent, 'Linux'))
                                            Linux
                                        @else
                                            Sistema
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                        {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($sessions->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No hay sesiones registradas</h3>
                    <p class="mt-2 text-sm text-gray-500">Cuando los usuarios se conecten, aparecerán aquí.</p>
                </div>
            @endif
    </div>
</x-app-layout>

    