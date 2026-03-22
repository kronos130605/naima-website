<header
    class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50 dark:bg-slate-950/80 dark:border-slate-800"
    x-data="{ mobileOpen: false, localeOpen: false, accountOpen: false }"
    @keydown.escape.window="mobileOpen = false; localeOpen = false; accountOpen = false"
>
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between gap-4">

        {{-- LEFT: hamburger (mobile-only) + logo --}}
        <div class="flex items-center gap-3">
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 p-2 text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                aria-label="{{ __('site.header.open_menu') }}"
                :aria-expanded="mobileOpen.toString()"
                @click="mobileOpen = true"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <a href="/{{ $locale }}" class="flex items-center gap-2 shrink-0">
                <img src="{{ Vite::asset('resources/images/logo/logo_1_light.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-8 w-auto object-contain dark:hidden" />
                <img src="{{ Vite::asset('resources/images/logo/logo_1_dark.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-8 w-auto object-contain hidden dark:block" />
            </a>
        </div>

        {{-- CENTER: desktop nav --}}
        @if(request()->routeIs('site.home'))
            <nav class="hidden lg:flex items-center gap-1 text-sm font-medium text-slate-700 dark:text-slate-200">
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#about">{{ __('site.nav.about') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#programs">{{ __('site.nav.programs') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#strategy">{{ __('site.nav.strategy') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#resources">{{ __('site.nav.resources') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#pricing">{{ __('site.nav.pricing') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#faq">{{ __('site.nav.faq') }}</a>
                <a class="rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400" href="#contact">{{ __('site.nav.contact') }}</a>
            </nav>
        @else
            @php $lnk = 'rounded-lg px-3 py-2 hover:bg-blue-50 hover:text-blue-600 transition-colors dark:hover:bg-slate-800 dark:hover:text-blue-400'; @endphp
            <nav class="hidden lg:flex items-center gap-1 text-sm font-medium text-slate-700 dark:text-slate-200">
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
                class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 p-2 text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
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
                    class="inline-flex items-center gap-1.5 rounded-lg border border-blue-200 bg-white/80 px-2.5 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                    aria-label="{{ __('site.header.select_language') }}"
                    :aria-expanded="localeOpen.toString()"
                    @click="localeOpen = !localeOpen"
                >
                    <span aria-hidden="true">{{ ($localeFlag[$locale] ?? '🌐') }}</span>
                    <span>{{ strtoupper($locale) }}</span>
                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div
                    class="absolute right-0 mt-2 w-36 rounded-xl border border-blue-100 bg-white shadow-xl p-1 dark:border-slate-700 dark:bg-slate-900"
                    x-cloak x-show="localeOpen" x-transition.origin.top.right
                >
                    @foreach($locales as $l)
                        @php $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l; @endphp
                        <a
                            href="{{ $switchPath }}"
                            onclick="try{sessionStorage.setItem('restoreScroll','1');sessionStorage.setItem('restoreScrollX',String(window.scrollX||0));sessionStorage.setItem('restoreScrollY',String(window.scrollY||0));}catch(e){};event.preventDefault();window.location.href=this.href+(window.location.hash||'');"
                            class="flex items-center justify-between gap-2 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800 {{ $l === $locale ? 'bg-blue-50 dark:bg-slate-800' : '' }}"
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
                        class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white/80 px-2.5 py-2 text-sm font-semibold text-slate-900 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-800"
                        :aria-expanded="accountOpen.toString()"
                        @click="accountOpen = !accountOpen"
                    >
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-xs font-bold text-white">{{ $initial }}</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-52 rounded-xl border border-blue-100 bg-white shadow-xl p-1 dark:border-slate-700 dark:bg-slate-900"
                        x-cloak x-show="accountOpen" x-transition.origin.top.right
                    >
                        <div class="px-3 py-2 border-b border-blue-50 dark:border-slate-800 mb-1">
                            <div class="text-sm font-semibold text-slate-900 dark:text-slate-100 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800">
                                <span>{{ __('Dashboard') }}</span><span aria-hidden="true">→</span>
                            </a>
                            <a href="{{ route('profile.edit', ['locale' => $locale]) }}" class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800">
                                <span>{{ __('Profile') }}</span><span aria-hidden="true">→</span>
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}" class="px-1 pt-1 border-t border-blue-50 dark:border-slate-800 mt-1">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between gap-3 rounded-lg px-2 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors dark:text-red-400 dark:hover:bg-red-950/30">
                                <span>{{ __('Log Out') }}</span><span aria-hidden="true">⎋</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Login / Register for guests (desktop only) --}}
                <a
                    href="{{ route('login', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white/80 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:border-blue-300 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    {{ __('Log in') }}
                </a>
                <a
                    href="{{ route('register', ['locale' => $locale]) }}"
                    class="hidden lg:inline-flex items-center justify-center rounded-lg border border-blue-600 bg-white/80 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-50 transition-colors dark:border-blue-500 dark:bg-slate-900/80 dark:text-blue-400 dark:hover:bg-slate-800"
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
                class="absolute left-0 top-0 h-full w-72 max-w-[85vw] flex flex-col bg-white shadow-2xl dark:bg-slate-900"
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
                <div class="flex items-center justify-between px-5 py-4 border-b border-blue-100 dark:border-slate-700">
                    <a href="/{{ $locale }}" @click="mobileOpen = false">
                        <img src="{{ Vite::asset('resources/images/logo/logo_1_light.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-7 w-auto object-contain dark:hidden" />
                        <img src="{{ Vite::asset('resources/images/logo/logo_1_dark.png') }}" alt="{{ $brand['name'] ?? 'FrenchBoost' }}" class="h-7 w-auto object-contain hidden dark:block" />
                    </a>
                    <button
                        type="button"
                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100"
                        @click="mobileOpen = false"
                        aria-label="{{ __('site.header.close') }}"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Nav links (scrollable) --}}
                <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
                    @php $ni = 'flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-blue-400'; @endphp

                    {{-- Pages --}}
                    <a class="{{ $ni }}" href="{{ route('site.about',    ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.about') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.programs', ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.programs') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.method',   ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.strategy') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.pricing',  ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.pricing') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.faq',      ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.faq') }}</a>
                    <a class="{{ $ni }}" href="{{ route('site.contact',  ['locale' => $locale]) }}" @click="mobileOpen = false">{{ __('site.nav.contact') }}</a>

                    {{-- Book Free Assessment --}}
                    <div class="pt-2 pb-1">
                        <a
                            class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:shadow-md hover:scale-[1.01] transition-all"
                            href="{{ route('site.booking', ['locale' => $locale]) }}"
                            @click="mobileOpen = false"
                        >
                            <span class="text-base">📅</span>
                            {{ __('site.cta.book_free_assessment') }}
                        </a>
                    </div>

                    {{-- Resources section divider --}}
                    <div class="pt-3 pb-1 px-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">{{ __('site.sidebar.resources_title') }}</p>
                    </div>
                    <a class="{{ $ni }}" href="{{ route('site.mind-maps', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-base">🗺</span> {{ __('site.sidebar.mind_maps') }}
                    </a>
                    <a class="{{ $ni }}" href="{{ route('site.videos', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-base">🎬</span> {{ __('site.sidebar.videos') }}
                    </a>
                    <a class="{{ $ni }}" href="{{ route('site.worksheets', ['locale' => $locale]) }}" @click="mobileOpen = false">
                        <span class="text-base">📄</span> {{ __('site.sidebar.worksheets') }}
                    </a>
                </nav>

                {{-- Drawer footer --}}
                <div class="px-5 py-4 border-t border-blue-100 dark:border-slate-700 space-y-3">

                    {{-- Auth state --}}
                    @auth
                        <div class="rounded-xl border border-blue-100 bg-blue-50/50 px-4 py-3 dark:border-slate-700 dark:bg-slate-800/50 flex items-center justify-between gap-3">
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-slate-900 dark:text-slate-100 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('dashboard', ['locale' => $locale]) }}" class="shrink-0 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700 transition-colors">
                                    {{ __('Dashboard') }}
                                </a>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}">
                            @csrf
                            <button type="submit" class="w-full rounded-xl border border-red-200 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors dark:border-red-800 dark:text-red-400 dark:hover:bg-red-950/30">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login', ['locale' => $locale]) }}" class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-center text-sm font-medium text-slate-700 hover:bg-blue-50 hover:border-blue-300 transition-colors dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800" @click="mobileOpen = false">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register', ['locale' => $locale]) }}" class="block w-full rounded-xl border border-blue-600 px-4 py-2.5 text-center text-sm font-medium text-blue-700 hover:bg-blue-50 transition-colors dark:border-blue-500 dark:text-blue-400 dark:hover:bg-slate-800" @click="mobileOpen = false">
                            {{ __('Register') }}
                        </a>
                    @endauth

                </div>
            </div>
        </div>
    </template>
</header>
