<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Settings</h2>
    </x-slot>

    @include('admin.partials.settings', ['user' => $user])
</x-app-layout>
