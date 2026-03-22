<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/theme.js', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div
            class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"
            x-data="{ adminModalOpen: false }"
            @open-admin-modal.window="adminModalOpen = true"
            @close-admin-modal.window="adminModalOpen = false"
            @keydown.escape.window="adminModalOpen = false"
        >
            @include('layouts.navigation')

            <!-- Page Content -->
            <main id="admin-content">
                {{ $slot }}
            </main>

            <!-- Shared admin modal -->
            <div x-show="adminModalOpen" x-cloak class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto py-10 px-4">

                    <!-- Backdrop -->
                    <div
                        class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
                        @click="adminModalOpen = false"
                        x-show="adminModalOpen"
                        x-transition:enter="ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    ></div>

                    <!-- Panel -->
                    <div
                        class="relative z-10 w-full max-w-2xl"
                        x-show="adminModalOpen"
                        x-transition:enter="ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                    >
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">

                            <!-- Modal header bar -->
                            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                                <h2 id="admin-modal-title" class="text-base font-semibold text-gray-900 dark:text-gray-100"></h2>
                                <button
                                    type="button"
                                    @click="adminModalOpen = false"
                                    class="rounded-lg p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-200 dark:hover:bg-gray-800 transition-colors"
                                    aria-label="Close"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <!-- HTMX loads form here -->
                            <div id="admin-modal-content" class="overflow-y-auto max-h-[80vh]">
                                <div class="p-8 text-center text-gray-400">
                                    <svg class="animate-spin w-6 h-6 mx-auto mb-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    Loading…
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </body>
</html>
