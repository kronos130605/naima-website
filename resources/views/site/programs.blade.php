<x-site-layout title="Programs — FrenchBoost" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-emerald-600 via-teal-600 to-blue-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                🎓 {{ __('site.nav.programs') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                Programs & Offerings
            </h1>
            <p class="mt-4 text-lg text-emerald-100 max-w-xl mx-auto">
                Personalized French tutoring programs designed for every level, from kindergarten to university.
            </p>
        </div>
    </section>

    {{-- Programs section --}}
    <x-site.programs :programs="$programs" />

    {{-- Benefits --}}
    <x-site.benefits :benefits="$benefits" />

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">Find the right program for your child</h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">Book a free assessment to identify your child's needs and find the best-fit program.</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
