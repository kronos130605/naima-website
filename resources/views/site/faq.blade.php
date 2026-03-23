<x-site-layout :title="__('site.page_title.faq')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-cyan-600 via-sky-600 to-blue-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                💬 {{ __('site.nav.faq') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ __('site.faq.hero_title') }}
            </h1>
            <p class="mt-4 text-lg text-cyan-100 max-w-xl mx-auto">
                {{ __('site.faq.hero_body') }}
            </p>
        </div>
    </section>

    {{-- FAQ section --}}
    <x-site.faq :faq="$faq" />

    {{-- Still have questions? --}}
    <section class="py-16 px-4 bg-slate-50 dark:bg-slate-900">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('site.faq.still_title') }}</h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">{{ __('site.faq.still_body') }}</p>
            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                <a
                    href="{{ route('site.contact', ['locale' => $locale]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm"
                >
                    ✉️ {{ __('site.nav.contact') }}
                </a>
                <a
                    href="{{ route('site.booking', ['locale' => $locale]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
                >
                    📅 {{ __('site.cta.book_free_assessment') }}
                </a>
            </div>
        </div>
    </section>

</x-site-layout>
