<nav
    x-data="{
        open: false,
        navPath: window.location.pathname,
        navSearch: window.location.search,
        init() {
            document.addEventListener('htmx:afterSettle', () => {
                this.navPath = window.location.pathname;
                this.navSearch = window.location.search;
            });
            window.addEventListener('popstate', () => {
                this.navPath = window.location.pathname;
                this.navSearch = window.location.search;
            });
        }
    }"
    class="bg-white/80 backdrop-blur-md border-b border-blue-100 dark:bg-slate-950/80 dark:border-slate-800"
>
    @php
        $locale = app()->getLocale();
        $currentPath = request()->getPathInfo();
        $localeAlternates = [];
        foreach (['en', 'fr'] as $l) {
            $altPath = preg_replace('#^/' . preg_quote($locale, '#') . '(/|$)#', '/' . $l . '$1', $currentPath);
            $qs = request()->getQueryString();
            $localeAlternates[$l] = $altPath . ($qs ? '?' . $qs : '');
        }
        $localeFlag = ['en' => '🇨🇦', 'fr' => '🇫🇷'];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo → public site home -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('site.home', ['locale' => $locale]) }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Admin tabs with HTMX -->
                <div class="hidden sm:-my-px sm:ms-6 sm:flex sm:items-stretch">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        @php
                            $adminTabs = config('frenchboost.admin_nav');
                        @endphp
                        @foreach($adminTabs as $tab)
                            <a
                                href="{{ route($tab['route'], ['locale' => $locale]) }}"
                                hx-get="{{ route($tab['route'], ['locale' => $locale]) }}"
                                hx-target="#admin-content"
                                hx-swap="innerHTML"
                                hx-push-url="true"
                                hx-indicator="#tab-spinner"
                                :class="navPath.includes('{{ $tab['urlMatch'] }}')
                                    ? 'border-blue-500 text-blue-600 dark:border-blue-400 dark:text-blue-400'
                                    : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-300 dark:hover:text-white dark:hover:border-slate-600'"
                                class="inline-flex items-center px-4 border-b-2 text-sm font-medium transition-colors"
                            >{{ __('admin.nav.' . $tab['label_key']) }}</a>
                        @endforeach
                        <span id="tab-spinner" class="htmx-indicator inline-flex items-center px-2 text-blue-500">
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Right side: theme toggle + locale + user dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-2 sm:ms-6">

                @auth
                    <!-- Design theme toggle (new/normal) -->
                    @php
                        $designThemeCurrent = auth()->user()->getThemePreference();
                        $designThemeNext = $designThemeCurrent === 'new' ? 'normal' : 'new';
                    @endphp
                    <form method="POST" action="{{ route('theme.update', ['locale' => $locale]) }}">
                        @csrf
                        <input type="hidden" name="theme" value="{{ $designThemeNext }}">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white/80 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                        >
                            {{ strtoupper($designThemeCurrent) }}
                        </button>
                    </form>
                @endauth

                <!-- Theme toggle -->
                <button
                    type="button"
                    onclick="window.__theme?.toggle()"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white/80 p-2 text-slate-600 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-300 dark:hover:bg-slate-800"
                    aria-label="Toggle theme"
                >
                    <svg class="h-4 w-4 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0-1.414-1.414M7.05 7.05 5.636 5.636M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"/>
                    </svg>
                    <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z"/>
                    </svg>
                </button>

                <!-- Locale switcher -->
                <div class="relative" x-data="{ localeOpen: false }" @click.outside="localeOpen = false">
                    <button
                        type="button"
                        @click="localeOpen = !localeOpen"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white/80 px-2.5 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 transition-colors dark:border-slate-700 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        <span>{{ $localeFlag[$locale] ?? '🌐' }}</span>
                        <span>{{ strtoupper($locale) }}</span>
                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-32 rounded-xl border border-slate-200 bg-white shadow-xl p-1 z-50 dark:border-slate-700 dark:bg-slate-900"
                        x-cloak x-show="localeOpen" x-transition.origin.top.right
                    >
                        @foreach(['en' => '🇨🇦', 'fr' => '🇫🇷'] as $l => $flag)
                            <a
                                :href="navPath.replace(/^\/(en|fr)/, '/{{ $l }}') + navSearch"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors dark:text-slate-200 dark:hover:bg-slate-800 {{ $l === $locale ? 'bg-blue-50 dark:bg-slate-800' : '' }}"
                            >
                                <span>{{ $flag }}</span>
                                <span>{{ strtoupper($l) }}</span>
                                @if($l === $locale)<span class="ml-auto text-blue-600 dark:text-blue-400 text-xs">✓</span>@endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- User dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-700 bg-white/60 hover:text-slate-900 focus:outline-none transition ease-in-out duration-150 dark:bg-slate-950/60 dark:text-slate-200 dark:hover:text-white">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(auth()->user()->isAdmin())
                            <x-dropdown-link
                                hx-get="{{ route('admin.settings', ['locale' => $locale]) }}"
                                hx-target="#admin-content"
                                hx-swap="innerHTML"
                                hx-push-url="true"
                                href="{{ route('admin.settings', ['locale' => $locale]) }}"
                            >
                                {{ __('Settings') }}
                            </x-dropdown-link>
                        @else
                            <x-dropdown-link :href="route('profile.edit', ['locale' => $locale])">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}">
                            @csrf
                            <x-dropdown-link :href="route('logout', ['locale' => $locale])"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-700 hover:bg-blue-50 focus:outline-none transition duration-150 ease-in-out dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->check() && auth()->user()->isAdmin())
                @php
                    $mobileTabs = config('frenchboost.admin_nav');
                @endphp
                @foreach($mobileTabs as $tab)
                    <x-responsive-nav-link :href="route($tab['route'], ['locale' => $locale])" :active="request()->routeIs($tab['route'])">
                        {{ __('admin.nav.' . $tab['label_key']) }}
                    </x-responsive-nav-link>
                @endforeach
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-slate-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.settings', ['locale' => $locale])">
                        {{ __('Settings') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('profile.edit', ['locale' => $locale])">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout', ['locale' => $locale])"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Mobile locale switcher -->
                <div class="px-4 pt-2 flex gap-2">
                    @foreach(['en' => '🇨🇦', 'fr' => '🇫🇷'] as $l => $flag)
                        <a
                            :href="navPath.replace(/^\/(en|fr)/, '/{{ $l }}') + navSearch"
                            class="flex items-center gap-1.5 rounded-lg border px-3 py-1.5 text-sm transition-colors {{ $l === $locale ? 'border-blue-600 bg-blue-50 text-blue-700 dark:bg-slate-800 dark:text-blue-400' : 'border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                        >
                            <span>{{ $flag }}</span><span>{{ strtoupper($l) }}</span>
                        </a>
                    @endforeach

                    <!-- Mobile theme toggle -->
                    <button
                        type="button"
                        onclick="window.__theme?.toggle()"
                        class="flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition-colors dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                    >
                        <svg class="h-4 w-4 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0-1.414-1.414M7.05 7.05 5.636 5.636M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"/></svg>
                        <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
