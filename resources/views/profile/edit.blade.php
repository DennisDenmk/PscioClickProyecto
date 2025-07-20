<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col md:flex-row md:gap-8">
                <div class="w-full md:w-1/2">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="w-full md:w-1/2">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
