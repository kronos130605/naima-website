<x-site-layout title="{{ __('site.worksheets.page_title') ?? 'Worksheets' }} — FrenchBoost" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-teal-600 via-emerald-600 to-cyan-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                📄 {{ __('site.sidebar.worksheets') ?? 'Worksheets' }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ $locale === 'fr' ? 'Fiches de Travail' : 'French Worksheets' }}
            </h1>
            <p class="mt-4 text-lg text-teal-100 max-w-xl mx-auto">
                {{ $locale === 'fr'
                    ? 'Téléchargez des fiches d\'exercices pour pratiquer à votre rythme.'
                    : 'Download printable exercise sheets to practice at your own pace.' }}
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-12 px-4 bg-slate-50 dark:bg-slate-900 min-h-[60vh]"
        x-data="{ activeLevel: 'all' }"
    >
        <div class="mx-auto max-w-6xl">

            @if($grouped->isEmpty())
                {{-- Empty state --}}
                <div class="text-center py-20">
                    <div class="text-7xl mb-6">📄</div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">
                        {{ $locale === 'fr' ? 'Fiches bientôt disponibles' : 'Worksheets coming soon' }}
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                        {{ $locale === 'fr'
                            ? 'Nous préparons une bibliothèque de fiches d\'exercices. Revenez bientôt !'
                            : 'We\'re building a library of printable exercises. Check back soon!' }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
                    >
                        📅 {{ __('site.cta.book_free_assessment') }}
                    </a>
                </div>
            @else
                @php
                    $levelLabels = [
                        'beginner'     => $locale === 'fr' ? 'Débutant (K–3)'      : 'Beginner (K–3)',
                        'intermediate' => $locale === 'fr' ? 'Intermédiaire (4–8)' : 'Intermediate (4–8)',
                        'advanced'     => $locale === 'fr' ? 'Avancé (9–12)'       : 'Advanced (9–12)',
                        'general'      => $locale === 'fr' ? 'Général'              : 'General',
                    ];
                    $allLevels = $grouped->keys()->toArray();
                @endphp

                {{-- Level filter tabs --}}
                <div class="flex flex-wrap gap-2 mb-10">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all' ? 'bg-teal-600 text-white border-teal-600' : 'bg-white text-slate-600 border-slate-200 hover:border-teal-300 hover:text-teal-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600'"
                        class="rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors"
                    >All</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}' ? 'bg-teal-600 text-white border-teal-600' : 'bg-white text-slate-600 border-slate-200 hover:border-teal-300 hover:text-teal-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600'"
                            class="rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Worksheets grouped by level --}}
                @foreach($grouped as $level => $worksheets)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="mb-12">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 rounded-full bg-teal-500 inline-block"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($worksheets as $worksheet)
                                <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow flex flex-col">

                                    {{-- Preview --}}
                                    @if($worksheet->preview_image)
                                        <div class="aspect-[4/3] bg-slate-100 dark:bg-slate-700 overflow-hidden">
                                            <img
                                                src="{{ Storage::url($worksheet->preview_image) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                alt="{{ $worksheet->title($lang) }}"
                                                loading="lazy"
                                            >
                                        </div>
                                    @else
                                        <div class="aspect-[4/3] bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                            <span class="text-5xl opacity-40">📄</span>
                                        </div>
                                    @endif

                                    {{-- Info --}}
                                    <div class="p-4 flex-1 flex flex-col">
                                        @if($worksheet->topic($lang))
                                            <span class="inline-block mb-2 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-xs font-bold px-2.5 py-0.5 self-start">
                                                {{ $worksheet->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="font-semibold text-slate-900 dark:text-slate-100 text-sm leading-snug flex-1">
                                            {{ $worksheet->title($lang) }}
                                        </h3>
                                        @if($worksheet->description($lang))
                                            <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                                                {{ $worksheet->description($lang) }}
                                            </p>
                                        @endif

                                        {{-- Download button --}}
                                        <div class="mt-4">
                                            @if($worksheet->file_path)
                                                <a
                                                    href="{{ Storage::url($worksheet->file_path) }}"
                                                    target="_blank"
                                                    download
                                                    class="inline-flex items-center gap-1.5 rounded-lg bg-teal-600 px-4 py-2 text-xs font-semibold text-white hover:bg-teal-700 transition-colors shadow-sm"
                                                >
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    {{ $locale === 'fr' ? 'Télécharger PDF' : 'Download PDF' }}
                                                </a>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 dark:bg-slate-700 px-4 py-2 text-xs font-semibold text-slate-400 dark:text-slate-500">
                                                    {{ $locale === 'fr' ? 'Bientôt disponible' : 'Coming soon' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                {{ $locale === 'fr' ? 'Prêt à commencer ?' : 'Ready to get started?' }}
            </h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">
                {{ $locale === 'fr'
                    ? 'Les fiches complètent les séances — réservez une évaluation gratuite pour aller plus loin.'
                    : 'Worksheets complement live sessions — book a free assessment to take the next step.' }}
            </p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
