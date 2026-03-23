<header
    class="bg-gradient-to-r from-blue-400 via-purple-400 to-blue-400 border-b-4 border-yellow-300 sticky top-0 z-50 shadow-lg dark:bg-slate-950/80 dark:border-purple-400"
    x-data="{ mobileOpen: false, localeOpen: false, accountOpen: false }"
    @keydown.escape.window="mobileOpen = false; localeOpen = false; accountOpen = false"
>
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between gap-4">

        {{-- LEFT: hamburger (mobile-only) + logo --}}
        <div class="flex items-center gap-3">
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-2xl border-4 border-white bg-yellow-300 p-3 text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 shadow-lg dark:bg-yellow-400"
                aria-label="{{ __('site.header.open_menu') }}"
                :aria-expanded="mobileOpen.toString()"
                @click="mobileOpen = true"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <a href="/{{ $locale }}" class="flex items-center gap-3 bg-white rounded-2xl px-4 py-2 shadow-lg hover:scale-110 transition-all hover:-rotate-3 border-4 border-yellow-300">
                <img src="{{ Vite::asset('resources/images/logo/logo_1_light.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-8 w-auto object-contain dark:hidden" />
                <img src="{{ Vite::asset('resources/images/logo/logo_1_dark.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-8 w-auto object-contain hidden dark:block" />
            </a>
        </div>

        {{-- CENTER: desktop nav --}}
        @if(request()->routeIs('site.home'))
            <nav class="hidden lg:flex items-center gap-2 text-sm font-bold text-white">
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#about">{{ __('site.nav.about') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#programs">{{ __('site.nav.programs') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#strategy">{{ __('site.nav.strategy') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#resources">{{ __('site.nav.resources') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#pricing">{{ __('site.nav.pricing') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#faq">{{ __('site.nav.faq') }}</a>
                <a class="rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg" href="#contact">{{ __('site.nav.contact') }}</a>
            </nav>
        @else
            @php $lnk = 'rounded-full px-4 py-2 bg-white/20 hover:bg-white hover:text-blue-900 transition-all hover:scale-110 border-2 border-white/30 shadow-lg'; @endphp
            <nav class="hidden lg:flex items-center gap-2 text-sm font-bold text-white">
                <a class="{{ $lnk }}" href="{{ route('site.programs', ['locale' => $locale]) }}">{{ __('site.nav.programs') }}</a>
                <a class="{{ $lnk }}" href="{{ route('site.method',   ['locale' => $locale]) }}">{{ __('site.nav.strategy') }}</a>
                <a class="{{ $lnk }}" href="{{ route('site.pricing',  ['locale' => $locale]) }}">{{ __('site.nav.pricing') }}</a>
                <a class="{{ $lnk }}" href="{{ route('site.mind-maps',['locale' => $locale]) }}">{{ __('site.nav.resources') }}</a>
                <a class="{{ $lnk }}" href="{{ route('site.contact',  ['locale' => $locale]) }}">{{ __('site.nav.contact') }}</a>
            </nav>
        @endif

        {{-- RIGHT: utility buttons --}}
        <div class="flex items-center gap-2 shrink-0">

            {{-- Theme toggle --}}
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-2xl border-4 border-white bg-yellow-300 p-3 text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 hover:rotate-12 shadow-lg dark:bg-yellow-400"
                aria-label="Toggle theme"
                @click="window.__theme?.toggle()"
            >
                <svg class="h-4 w-4 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0-1.414-1.414M7.05 7.05 5.636 5.636M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"/>
                </svg>
                <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z"/>
                </svg>
            </button>

            {{-- Locale switcher --}}
            <div class="relative" @click.outside="localeOpen = false">
                <button
                    type="button"
                    class="inline-flex items-center gap-2 rounded-2xl border-4 border-white bg-purple-300 px-4 py-2.5 text-base font-bold text-purple-900 hover:bg-purple-400 transition-all hover:scale-110 shadow-lg dark:bg-purple-400"
                    aria-label="{{ __('site.header.select_language') }}"
                    :aria-expanded="localeOpen.toString()"
                    @click="localeOpen = !localeOpen"
                >
                    <span aria-hidden="true">{{ ($localeFlag[$locale] ?? '🌐') }}</span>
                    <span>{{ strtoupper($locale) }}</span>
                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div
                    class="absolute right-0 mt-2 w-40 rounded-2xl border-4 border-purple-300 bg-white shadow-2xl p-2 dark:border-purple-400 dark:bg-slate-900"
                    x-cloak x-show="localeOpen" x-transition.origin.top.right
                >
                    @foreach($locales as $l)
                        @php $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l; @endphp
                        <a
                            href="{{ $switchPath }}"
                            onclick="try{sessionStorage.setItem('restoreScroll','1');sessionStorage.setItem('restoreScrollX',String(window.scrollX||0));sessionStorage.setItem('restoreScrollY',String(window.scrollY||0));}catch(e){};event.preventDefault();window.location.href=this.href+(window.location.hash||'');"
                            class="flex items-center justify-between gap-2 rounded-xl px-4 py-2.5 text-base font-bold hover:bg-purple-100 transition-all hover:scale-105 dark:text-slate-200 dark:hover:bg-purple-900/30 {{ $l === $locale ? 'bg-purple-100 border-2 border-purple-400 dark:bg-purple-900/30' : '' }}"
                        >
                            <span class="flex items-center gap-2">
                                <span aria-hidden="true">{{ ($localeFlag[$l] ?? '🌐') }}</span>
                                <span>{{ strtoupper($l) }}</span>
                            </span>
                            @if($l === $locale)<span class="text-blue-600 dark:text-blue-400 text-xs">✓</span>@endif
                        </a>
                    @endforeach
                </div>
            </div>

            @auth
                @php $initial = strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)); @endphp
                <div class="relative" @click.outside="accountOpen = false">
                    <button
                        type="button"
                        class="inline-flex items-center gap-2 rounded-2xl border-4 border-white bg-yellow-300 px-4 py-2.5 text-base font-black text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 shadow-lg dark:bg-yellow-400"
                        :aria-expanded="accountOpen.toString()"
                        @click="accountOpen = !accountOpen"
                    >
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-purple-600 text-sm font-black text-white border-2 border-white shadow-lg">{{ $initial }}</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-56 rounded-2xl border-4 border-yellow-300 bg-white shadow-2xl p-2 dark:border-yellow-400 dark:bg-slate-900"
                        x-cloak x-show="accountOpen" x-transition.origin.top.right
                    >
                        <div class="px-4 py-3 border-b-4 border-yellow-200 dark:border-yellow-600 mb-2 bg-yellow-50 rounded-xl dark:bg-yellow-900/20">
                            <div class="text-base font-black text-blue-900 dark:text-blue-200 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-bold text-blue-700 dark:text-blue-300 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-xl px-4 py-2.5 text-base font-bold hover:bg-blue-100 transition-all hover:scale-105 dark:text-slate-200 dark:hover:bg-blue-900/30">
                                <span>{{ __('Dashboard') }}</span><span aria-hidden="true">→</span>
                            </a>
                            <a href="{{ route('profile.edit', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-xl px-4 py-2.5 text-base font-bold hover:bg-blue-100 transition-all hover:scale-105 dark:text-slate-200 dark:hover:bg-blue-900/30">
                                <span>{{ __('Profile') }}</span><span aria-hidden="true">→</span>
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}" class="px-1 pt-2 border-t-4 border-yellow-200 dark:border-yellow-600 mt-2">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between gap-3 rounded-xl px-4 py-2.5 text-base font-bold text-red-600 hover:bg-red-100 transition-all hover:scale-105 border-2 border-red-300 dark:text-red-400 dark:hover:bg-red-950/30 dark:border-red-600">
                                <span>{{ __('Log Out') }}</span><span aria-hidden="true">⎋</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Login / Register for guests (desktop only) --}}
                <a
                    href="{{ route('login', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-2xl border-4 border-white bg-white/90 px-5 py-2.5 text-base font-bold text-blue-900 hover:bg-white transition-all hover:scale-110 shadow-lg dark:bg-slate-900 dark:text-blue-400"
                >
                    {{ __('Log in') }}
                </a>
                <a
                    href="{{ route('register', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-2xl border-4 border-white bg-yellow-300 px-5 py-2.5 text-base font-black text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 shadow-lg dark:bg-yellow-400"
                >
                    {{ __('Register') }}
                </a>
            @endauth

        </div>
    </div>

    {{-- Mobile sidebar --}}
    <template x-teleport="body">
        <div
            class="fixed inset-0 z-[9999]"
            x-cloak x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            {{-- Backdrop --}}
            <button
                type="button"
                class="absolute inset-0 bg-slate-900/80"
                aria-label="{{ __('site.header.close_menu') }}"
                @click="mobileOpen = false"
            ></button>

            {{-- Drawer --}}
            <div
                class="absolute left-0 top-0 h-full w-80 max-w-[85vw] flex flex-col bg-gradient-to-br from-blue-50 via-purple-50 to-yellow-50 shadow-2xl border-r-8 border-yellow-300 dark:bg-slate-900 dark:border-purple-400"
                x-show="mobileOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-trap.noscroll="mobileOpen"
            >
                {{-- Drawer header --}}
                <div class="flex items-center justify-between px-5 py-5 border-b-4 border-purple-300 bg-white/80 dark:border-purple-600 dark:bg-slate-900/80">
                    <a href="/{{ $locale }}" @click="mobileOpen = false" class="flex items-center gap-2 bg-white rounded-2xl px-3 py-2 shadow-lg border-4 border-yellow-300 hover:scale-105 transition-all">
                        <img src="{{ Vite::asset('resources/images/logo/logo_1_light.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-7 w-auto object-contain dark:hidden" />
                        <img src="{{ Vite::asset('resources/images/logo/logo_1_dark.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-7 w-auto object-contain hidden dark:block" />

                    </a>
                    <button
                        type="button"
                        class="rounded-2xl p-3 bg-yellow-300 text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 hover:rotate-12 shadow-lg border-4 border-white dark:bg-yellow-400"
                        @click="mobileOpen = false"
                        aria-label="{{ __('site.header.close') }}"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Nav links (scrollable) --}}
                <nav class="flex-1 overflow-y-auto px-4 py-5 space-y-2">
                    @php $ni = 'flex items-center gap-3 rounded-2xl px-5 py-3.5 text-base font-bold text-blue-900 bg-white hover:bg-blue-100 transition-all hover:scale-105 shadow-lg border-4 border-blue-200 dark:text-blue-200 dark:bg-slate-800 dark:hover:bg-blue-900/30 dark:border-blue-600'; @endphp

                    {{-- Pages --}}
                    <a class="{{ $ni }}" href="{{ route('site.about',    ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.about') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.programs', ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.programs') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.method',   ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.strategy') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.pricing',  ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.pricing') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.faq',      ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.faq') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.contact',  ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.contact') }}</a>

                    {{-- Book Free Assessment --}}
                    <div class="pt-3 pb-2">
                        <a
                            class="flex items-center justify-center gap-3 rounded-full px-6 py-4 text-lg font-black bg-gradient-to-r from-pink-500 to-purple-600 text-white hover:shadow-2xl hover:shadow-purple-500/50 hover:scale-110 transition-all border-4 border-white shadow-xl"
                            href="{{ route('site.booking', ['locale' => $locale]) }}"
                            @click="mobileOpen = false"
                        >
                            <span class="text-2xl">📅</span>
                            {{ __('site.cta.book_free_assessment') }}
                        </a>
                    </div>

                    {{-- Resources section divider --}}
                    <div class="pt-4 pb-2 px-2">
                        <div class="bg-purple-400 rounded-2xl px-4 py-2 shadow-lg border-4 border-white">
                            <p class="text-sm font-black uppercase tracking-wider text-white">{{ __('site.sidebar.resources_title') }}</p>
                        </div>
                    </div>
                    <a class="{{ $ni }}" href="{{ route('site.mind-maps', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-2xl">🗺</span> {{ __('site.sidebar.mind_maps') }}
                    </a>
                    <a class="{{ $ni }}" href="{{ route('site.videos', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-2xl">🎬</span> {{ __('site.sidebar.videos') }}
                    </a>
                    <a class="{{ $ni }}" href="{{ route('site.worksheets', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-2xl">📄</span> {{ __('site.sidebar.worksheets') }}
                    </a>
                </nav>

                {{-- Drawer footer --}}
                <div class="px-5 py-5 border-t-4 border-purple-300 dark:border-purple-600 space-y-4 bg-white/80 dark:bg-slate-900/80">

                    {{-- Auth state --}}
                    @auth
                        <div class="rounded-2xl border-4 border-yellow-300 bg-yellow-50 px-5 py-4 dark:border-yellow-500 dark:bg-yellow-900/20 flex items-center justify-between gap-3 shadow-lg">
                            <div class="min-w-0">
                                <div class="text-base font-black text-blue-900 dark:text-blue-200 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-bold text-blue-700 dark:text-blue-300 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="shrink-0 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 px-4 py-2 text-sm font-black text-white hover:shadow-lg transition-all hover:scale-110 border-2 border-white shadow-md">
                                    {{ __('Dashboard') }}
                                </a>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}">
                            @csrf
                            <button type="submit" class="w-full rounded-2xl border-4 border-red-300 bg-white px-5 py-3.5 text-base font-bold text-red-600 hover:bg-red-100 transition-all hover:scale-105 shadow-lg dark:border-red-600 dark:bg-slate-800 dark:text-red-400 dark:hover:bg-red-950/30">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login', ['locale' => $locale]) }}" class="block w-full rounded-2xl border-4 border-blue-300 bg-white px-5 py-3.5 text-center text-base font-bold text-blue-900 hover:bg-blue-100 transition-all hover:scale-105 shadow-lg dark:border-blue-500 dark:bg-slate-800 dark:text-blue-300 dark:hover:bg-blue-900/30" @click="mobileOpen = false">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register', ['locale' => $locale]) }}" class="block w-full rounded-2xl border-4 border-white bg-yellow-300 px-5 py-3.5 text-center text-base font-black text-blue-900 hover:bg-yellow-400 transition-all hover:scale-105 shadow-lg dark:bg-yellow-400" @click="mobileOpen = false">
                            {{ __('Register') }}
                        </a>
                    @endauth

                </div>
            </div>
        </div>
    </template>
</header>
