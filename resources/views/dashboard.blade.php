<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-containers.main-body>
        <div class="p-6 text-gray-900">
            {{ __("You're logged in!") }}
        </div>
    </x-containers.main-body>
</x-app-layout>