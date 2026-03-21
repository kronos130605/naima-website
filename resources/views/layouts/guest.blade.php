<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'FrenchBoost') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/theme.js', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-900 dark:text-slate-100">
        <div class="min-h-screen flex">

            {{-- LEFT: brand panel (hidden on mobile) --}}
            <div class="hidden lg:flex lg:w-1/2 xl:w-[55%] relative flex-col justify-between p-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 overflow-hidden">

                {{-- Decorative circles --}}
                <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-white/5"></div>
                <div class="absolute top-1/3 -right-32 w-80 h-80 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-20 left-1/4 w-72 h-72 rounded-full bg-white/5"></div>

                {{-- Logo --}}
                <div class="relative z-10">
                    <a href="/{{ request()->route('locale') ?? app()->getLocale() }}" class="inline-flex items-center gap-3">
                        <x-application-logo class="h-10 w-auto brightness-0 invert" />
                    </a>
                </div>

                {{-- Main copy --}}
                <div class="relative z-10 space-y-8">
                    <div>
                        <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                            Boost your French,<br>
                            <span class="text-yellow-300">Boost your potential.</span>
                        </h1>
                        <p class="mt-4 text-lg text-blue-100 leading-relaxed max-w-sm">
                            Personalized online French tutoring for Grades K–12, with proven methods and a passion for student success.
                        </p>
                    </div>

                    {{-- Trust stats --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm px-5 py-4">
                            <p class="text-2xl font-extrabold text-white">4,000+</p>
                            <p class="text-sm text-blue-200 mt-0.5">Tutoring hours</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm px-5 py-4">
                            <p class="text-2xl font-extrabold text-white">K–12</p>
                            <p class="text-sm text-blue-200 mt-0.5">All levels</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm px-5 py-4">
                            <p class="text-2xl font-extrabold text-white">100%</p>
                            <p class="text-sm text-blue-200 mt-0.5">Online & flexible</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm px-5 py-4">
                            <p class="text-2xl font-extrabold text-yellow-300">5 ★</p>
                            <p class="text-sm text-blue-200 mt-0.5">Average rating</p>
                        </div>
                    </div>
                </div>

                {{-- Footer note --}}
                <p class="relative z-10 text-xs text-blue-300">
                    © {{ date('Y') }} FrenchBoost — Admin panel
                </p>
            </div>

            {{-- RIGHT: form panel --}}
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white dark:bg-slate-950 overflow-y-auto">

                {{-- Mobile-only logo --}}
                <div class="lg:hidden mb-8">
                    <a href="/{{ request()->route('locale') ?? app()->getLocale() }}">
                        <x-application-logo class="h-10 w-auto mx-auto" />
                    </a>
                </div>

                <div class="w-full max-w-sm">
                    {{ $slot }}
                </div>

                {{-- Theme toggle --}}
                <button
                    type="button"
                    onclick="window.__theme?.toggle()"
                    class="mt-10 inline-flex items-center gap-2 text-xs text-slate-400 hover:text-slate-600 transition-colors dark:hover:text-slate-300"
                >
                    <svg class="h-3.5 w-3.5 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0-1.414-1.414M7.05 7.05 5.636 5.636M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"/></svg>
                    <svg class="h-3.5 w-3.5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z"/></svg>
                    <span class="dark:hidden">Dark mode</span>
                    <span class="hidden dark:inline">Light mode</span>
                </button>
            </div>
        </div>
    </body>
</html>
