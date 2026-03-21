<header
    class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50 dark:bg-slate-950/80 dark:border-slate-800"
    x-data="{ mobileOpen: false, localeOpen: false, accountOpen: false }"
    @keydown.escape.window="mobileOpen = false; localeOpen = false"
>
    <div class="mx-auto max-w-6xl px-4 py-4 flex flex-nowrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                aria-label="{{ __('site.header.open_menu') }}"
                :aria-expanded="mobileOpen.toString()"
                @click="mobileOpen = true"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <a href="/{{ $locale }}" class="flex items-center gap-3 font-bold text-xl dark:text-slate-100">
                <img
                    src="{{ Vite::asset('resources/images/logo/logo_1.png') }}"
                    alt="{{ $brand['name'] ?? 'FrenchBoost' }}"
                    class="h-8 w-auto object-contain"
                />
            </a>
        </div>

        <div class="hidden md:flex items-center gap-3 min-w-0">
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium dark:text-slate-200">
                <a class="hover:text-blue-600 transition-colors dark:hover:text-blue-400" href="#about">{{ __('site.nav.about') }}</a>
                <a class="hover:text-blue-600 transition-colors dark:hover:text-blue-400" href="#strategy">{{ __('site.nav.strategy') }}</a>
                <a class="hover:text-blue-600 transition-colors dark:hover:text-blue-400" href="#pricing">{{ __('site.nav.pricing') }}</a>
                <a class="hover:text-blue-600 transition-colors dark:hover:text-blue-400" href="#faq">{{ __('site.nav.faq') }}</a>
                <a class="hover:text-blue-600 transition-colors dark:hover:text-blue-400" href="#contact">{{ __('site.nav.contact') }}</a>
            </nav>

            <button
                type="button"
                class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                aria-label="Toggle theme"
                @click="window.__theme?.toggle()"
            >
                <svg class="h-5 w-5 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0-1.414-1.414M7.05 7.05 5.636 5.636M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" />
                </svg>
                <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z" />
                </svg>
            </button>

            <div class="relative" @click.outside="localeOpen = false">
                <button
                    type="button"
                    class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                    aria-label="{{ __('site.header.select_language') }}"
                    :aria-expanded="localeOpen.toString()"
                    @click="localeOpen = !localeOpen"
                >
                    <span aria-hidden="true">{{ ($localeFlag[$locale] ?? '🌐') }}</span>
                    <span>{{ strtoupper($locale) }}</span>
                    <span class="text-xs" aria-hidden="true">▼</span>
                </button>

                <div
                    class="absolute right-0 mt-2 w-40 rounded-xl border border-blue-100 bg-white shadow-xl p-1 dark:border-slate-700 dark:bg-slate-900"
                    x-cloak
                    x-show="localeOpen"
                    x-transition.origin.top.right
                >
                    @foreach($locales as $l)
                        @php
                            $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l;
                        @endphp
                        <a
                            href="{{ $switchPath }}"
                            onclick="try{sessionStorage.setItem('restoreScroll','1');sessionStorage.setItem('restoreScrollX',String(window.scrollX||0));sessionStorage.setItem('restoreScrollY',String(window.scrollY||0));}catch(e){};event.preventDefault();window.location.href=this.href+(window.location.hash||'');"
                            class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800 {{ $l === $locale ? 'bg-blue-50 dark:bg-slate-800' : '' }}"
                        >
                            <span class="flex items-center gap-2">
                                <span aria-hidden="true">{{ ($localeFlag[$l] ?? '🌐') }}</span>
                                <span>{{ strtoupper($l) }}</span>
                            </span>
                            @if($l === $locale)
                                <span class="text-blue-600 dark:text-blue-400" aria-hidden="true">✓</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            @auth
                @php
                    $initial = strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1));
                @endphp
                <div class="relative" @click.outside="accountOpen = false">
                    <button
                        type="button"
                        class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm transition-all hover:bg-blue-50 hover:border-blue-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950"
                        aria-label="Account menu"
                        :aria-expanded="accountOpen.toString()"
                        @click="accountOpen = !accountOpen"
                    >
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-xs font-bold text-white">
                            {{ $initial }}
                        </span>
                        <span class="hidden lg:block max-w-[10rem] truncate">{{ Auth::user()->name }}</span>
                        <span class="text-xs" aria-hidden="true">▼</span>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-56 rounded-xl border border-blue-100 bg-white shadow-xl p-1 dark:border-slate-700 dark:bg-slate-900"
                        x-cloak
                        x-show="accountOpen"
                        x-transition.origin.top.right
                    >
                        <div class="px-3 py-2">
                            <div class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="h-px bg-blue-100 dark:bg-slate-800 my-1"></div>
                        <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800">
                            <span>{{ __('Dashboard') }}</span>
                            <span aria-hidden="true">→</span>
                        </a>
                        <a href="{{ route('profile.edit', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800">
                            <span>{{ __('Profile') }}</span>
                            <span aria-hidden="true">→</span>
                        </a>
                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}" class="px-1">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors text-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                                <span>{{ __('Log Out') }}</span>
                                <span aria-hidden="true">⎋</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a
                    href="{{ route('login', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm transition-all hover:bg-blue-50 hover:border-blue-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950"
                >
                    {{ __('Log in') }}
                </a>
                <a
                    href="{{ route('register', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl hover:scale-[1.01] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white active:scale-[0.99] dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950"
                >
                    {{ __('Register') }}
                </a>
            @endauth

            <a
                href="{{ $cta['booking_url'] ?? '#' }}"
                class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg hover:shadow-xl transition-all hover:scale-105"
            >
                {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </div>

    <template x-teleport="body">
        <div
            class="fixed inset-0 z-[9999]"
            x-cloak
            x-show="mobileOpen"
            x-transition.opacity.duration.200ms
        >
            <button
                type="button"
                class="absolute inset-0"
                style="background-color: rgb(15 23 42 / 0.95);"
                aria-label="{{ __('site.header.close_menu') }}"
                @click="mobileOpen = false"
            ></button>

            <div
                class="absolute left-0 top-0 h-full w-[320px] max-w-[85vw] shadow-2xl border-r border-blue-100 p-6 bg-white dark:border-slate-700 dark:bg-slate-900"
                x-show="mobileOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-trap.noscroll="mobileOpen"
            >
                <div class="flex items-center justify-between">
                    <a href="/{{ $locale }}" class="flex items-center gap-3">
                        <img
                            src="{{ Vite::asset('resources/images/logo/logo_1.png') }}"
                            alt="{{ $brand['name'] ?? 'FrenchBoost' }}"
                            class="h-8 w-auto object-contain"
                        />
                    </a>
                    <button type="button" class="rounded-lg border border-blue-200 px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800" @click="mobileOpen = false">
                        {{ __('site.header.close') }}
                    </button>
                </div>

                <nav class="mt-8 space-y-2">
                    <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800" href="#about" @click="mobileOpen = false">{{ __('site.nav.about') }}</a>
                    <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800" href="#strategy" @click="mobileOpen = false">{{ __('site.nav.strategy') }}</a>
                    <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800" href="#pricing" @click="mobileOpen = false">{{ __('site.nav.pricing') }}</a>
                    <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800" href="#faq" @click="mobileOpen = false">{{ __('site.nav.faq') }}</a>
                    <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800" href="#contact" @click="mobileOpen = false">{{ __('site.nav.contact') }}</a>
                </nav>

                <div class="mt-8 flex items-center gap-2">
                    @foreach($locales as $l)
                        @php
                            $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l;
                        @endphp
                        <a
                            href="{{ $switchPath }}"
                            onclick="try{sessionStorage.setItem('restoreScroll','1');sessionStorage.setItem('restoreScrollX',String(window.scrollX||0));sessionStorage.setItem('restoreScrollY',String(window.scrollY||0));}catch(e){};event.preventDefault();window.location.href=this.href+(window.location.hash||'');"
                            class="flex items-center justify-center gap-2 rounded-lg border px-3 py-2 text-sm transition-colors dark:text-slate-200 {{ $l === $locale ? 'border-blue-600 bg-blue-50 dark:border-blue-500 dark:bg-slate-800' : 'border-blue-200 hover:bg-blue-50 dark:border-slate-700 dark:hover:bg-slate-800' }}"
                        >
                            <span aria-hidden="true">{{ ($localeFlag[$l] ?? '🌐') }}</span>
                            <span>{{ strtoupper($l) }}</span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6 space-y-3">
                    @auth
                        <div class="rounded-xl border border-blue-100 bg-white/70 px-4 py-3 dark:border-slate-800 dark:bg-slate-950/60">
                            <div class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                        </div>

                        <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="block w-full rounded-xl border border-blue-200 bg-white/80 px-4 py-3 text-center text-sm font-semibold text-slate-900 transition-colors hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800">
                            {{ __('Dashboard') }}
                        </a>

                        <a href="{{ route('profile.edit', ['locale' => $locale]) }}" class="block w-full rounded-xl border border-blue-200 bg-white/80 px-4 py-3 text-center text-sm font-semibold text-slate-900 transition-colors hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800">
                            {{ __('Profile') }}
                        </a>

                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login', ['locale' => $locale]) }}" class="block w-full rounded-xl border border-blue-200 bg-white/80 px-4 py-3 text-center text-sm font-semibold text-slate-900 transition-colors hover:bg-blue-50 dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register', ['locale' => $locale]) }}" class="block w-full rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl">
                            {{ __('Register') }}
                        </a>
                    @endauth
                </div>

                <a
                    href="{{ $cta['booking_url'] ?? '#' }}"
                    class="mt-6 w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-[1.02]"
                    @click="mobileOpen = false"
                >
                    {{ __('site.cta.book_free_assessment') }}
                </a>
            </div>
        </div>
    </template>
</header>
