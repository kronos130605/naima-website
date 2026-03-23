<x-site-layout :title="__('site.page_title.pricing')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-amber-500 via-orange-500 to-rose-600 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                💰 {{ __('site.nav.pricing') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ __('site.pricing.hero_title') }}
            </h1>
            <p class="mt-4 text-lg text-amber-100 max-w-xl mx-auto">
                {{ __('site.pricing.hero_body') }}
            </p>
        </div>
    </section>

    {{-- Pricing section --}}
    <x-site.pricing :pricing="$pricing" :cta="$cta" :locale="$locale" />

    {{-- FAQ related to pricing --}}
    <section class="py-16 px-4 bg-slate-50 dark:bg-slate-900">
        <div class="mx-auto max-w-3xl text-center mb-10">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('site.pricing.questions_title') }}</h2>
            <p class="mt-2 text-slate-500 dark:text-slate-400">{{ __('site.pricing.questions_body') }}</p>
        </div>
        <div class="mx-auto max-w-3xl flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('site.faq', ['locale' => $locale]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
                💬 {{ __('site.pricing.browse_faq') }}
            </a>
            <a href="{{ route('site.contact', ['locale' => $locale]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
                ✉️ {{ __('site.pricing.contact_us') }}
            </a>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('site.pricing.help_title') }}</h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">{{ __('site.pricing.help_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
