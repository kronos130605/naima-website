<x-site-layout title="About — FrenchBoost" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                👩‍🏫 {{ __('site.nav.about') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                Meet Naima
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-xl mx-auto">
                Experienced French tutor dedicated to helping students of all ages reach their full potential.
            </p>
        </div>
    </section>

    {{-- About section --}}
    <x-site.about :about="$about" />

    {{-- Testimonials --}}
    <x-site.testimonials :testimonials="$testimonials" />

    {{-- Stats --}}
    <x-site.stats :stats="$stats" />

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">Ready to get started?</h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">Book a free assessment session and discover how FrenchBoost can help your child succeed.</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
