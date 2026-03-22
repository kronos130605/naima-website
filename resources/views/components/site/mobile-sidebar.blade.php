@props(['locale' => 'en', 'locales' => [], 'pathWithoutLocale' => '', 'localeFlag' => [], 'brand' => [], 'cta' => []])

<div
    class="fixed inset-0 z-[9999]"
    x-cloak
    x-show="mobileOpen"
    x-transition.opacity.duration.200ms
    @click.self="mobileOpen = false"
    style="background-color: rgb(15 23 42 / 0.95);"
>
    <div
        class="absolute left-0 top-0 h-full w-[320px] max-w-[85vw] bg-white shadow-2xl border-r border-blue-100 p-6"
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
            <span class="font-bold text-lg bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                {{ $brand['name'] ?? 'FrenchBoost' }}
            </span>
            <button type="button" class="rounded-lg border border-blue-200 px-3 py-2 text-sm hover:bg-blue-50 transition-colors" @click="mobileOpen = false">
                {{ __('site.header.close') }}
            </button>
        </div>

        <nav class="mt-8 space-y-2">
            <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#about" @click="mobileOpen = false">{{ __('site.nav.about') }}</a>
            <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#strategy" @click="mobileOpen = false">{{ __('site.nav.strategy') }}</a>
            <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#pricing" @click="mobileOpen = false">{{ __('site.nav.pricing') }}</a>
            <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#faq" @click="mobileOpen = false">{{ __('site.nav.faq') }}</a>
            <a class="block rounded-xl px-4 py-3 text-slate-800 hover:bg-blue-50 transition-colors" href="#contact" @click="mobileOpen = false">{{ __('site.nav.contact') }}</a>
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
            href="{{ route('site.booking', ['locale' => $locale]) }}"
            class="mt-6 w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-[1.02]"
            @click="mobileOpen = false"
        >
            {{ __('site.cta.book_free_assessment') }}
        </a>
    </div>
</div>
