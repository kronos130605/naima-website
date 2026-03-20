<header class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50">
    <div class="mx-auto max-w-6xl px-4 py-4 flex flex-nowrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <button
                type="button"
                data-mobile-nav-toggle
                class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-slate-700 hover:bg-blue-50 transition-colors"
                aria-label="{{ __('site.header.open_menu') }}"
            >
                <span class="block h-0.5 w-5 bg-current"></span>
                <span class="mt-1 block h-0.5 w-5 bg-current"></span>
                <span class="mt-1 block h-0.5 w-5 bg-current"></span>
            </button>

            <a href="/{{ $locale }}" class="flex items-center gap-3 font-bold text-xl">
                <img
                    src="{{ Vite::asset('resources/images/logo/logo_1.png') }}"
                    alt="{{ $brand['name'] ?? 'FrenchBoost' }}"
                    class="h-8 w-auto object-contain"
                />
            </a>
        </div>

        <div class="hidden md:flex items-center gap-3 min-w-0">
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium">
                <a class="hover:text-blue-600 transition-colors" href="#about">{{ __('site.nav.about') }}</a>
                <a class="hover:text-blue-600 transition-colors" href="#strategy">{{ __('site.nav.strategy') }}</a>
                <a class="hover:text-blue-600 transition-colors" href="#pricing">{{ __('site.nav.pricing') }}</a>
                <a class="hover:text-blue-600 transition-colors" href="#faq">{{ __('site.nav.faq') }}</a>
                <a class="hover:text-blue-600 transition-colors" href="#contact">{{ __('site.nav.contact') }}</a>
            </nav>

            <div class="relative" data-locale-dropdown>
                <button
                    type="button"
                    class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white/80 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-blue-50 transition-colors"
                    data-locale-dropdown-button
                    aria-label="{{ __('site.header.select_language') }}"
                >
                    <span aria-hidden="true">{{ ($localeFlag[$locale] ?? '🌐') }}</span>
                    <span>{{ strtoupper($locale) }}</span>
                    <span class="text-xs" aria-hidden="true">▼</span>
                </button>

                <div class="hidden absolute right-0 mt-2 w-40 rounded-xl border border-blue-100 bg-white shadow-xl p-1" data-locale-dropdown-menu>
                    @foreach($locales as $l)
                        @php
                            $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l;
                        @endphp
                        <a
                            href="{{ $switchPath }}"
                            class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm hover:bg-blue-50 transition-colors {{ $l === $locale ? 'bg-blue-50' : '' }}"
                        >
                            <span class="flex items-center gap-2">
                                <span aria-hidden="true">{{ ($localeFlag[$l] ?? '🌐') }}</span>
                                <span>{{ strtoupper($l) }}</span>
                            </span>
                            @if($l === $locale)
                                <span class="text-blue-600" aria-hidden="true">✓</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <a
                href="{{ $cta['booking_url'] ?? '#' }}"
                class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg hover:shadow-xl transition-all hover:scale-105"
            >
                {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </div>

    <div class="fixed inset-0 z-50 pointer-events-none opacity-0 transition-opacity duration-300 ease-out" data-mobile-nav>
        <button type="button" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" data-mobile-nav-close aria-label="{{ __('site.header.close_menu') }}"></button>
        <div class="absolute left-0 top-0 h-full w-[320px] max-w-[85vw] bg-white shadow-2xl border-r border-blue-100 p-6 translate-x-[-100%] transition-transform duration-300 ease-out" data-mobile-nav-panel>
            <div class="flex items-center justify-between">
                <span class="font-bold text-lg bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ $brand['name'] ?? 'FrenchBoost' }}
                </span>
                <button type="button" class="rounded-lg border border-blue-200 px-3 py-2 text-sm hover:bg-blue-50 transition-colors" data-mobile-nav-close>
                    {{ __('site.header.close') }}
                </button>
            </div>

            <nav class="mt-8 space-y-2">
                <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#about">{{ __('site.nav.about') }}</a>
                <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#strategy">{{ __('site.nav.strategy') }}</a>
                <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#pricing">{{ __('site.nav.pricing') }}</a>
                <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#faq">{{ __('site.nav.faq') }}</a>
                <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#contact">{{ __('site.nav.contact') }}</a>
            </nav>

            <div class="mt-8 flex items-center gap-2">
                @foreach($locales as $l)
                    @php
                        $switchPath = $pathWithoutLocale !== '' ? '/' . $l . '/' . $pathWithoutLocale : '/' . $l;
                    @endphp
                    <a
                        href="{{ $switchPath }}"
                        class="flex items-center justify-center gap-2 rounded-lg border px-3 py-2 text-sm transition-colors {{ $l === $locale ? 'border-blue-600 bg-blue-50' : 'border-blue-200 hover:bg-blue-50' }}"
                    >
                        <span aria-hidden="true">{{ ($localeFlag[$l] ?? '🌐') }}</span>
                        <span>{{ strtoupper($l) }}</span>
                    </a>
                @endforeach
            </div>

            <a
                href="{{ $cta['booking_url'] ?? '#' }}"
                class="mt-6 w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-[1.02]"
            >
                {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </div>
</header>
