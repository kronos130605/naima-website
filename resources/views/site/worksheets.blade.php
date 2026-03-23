<x-site-layout :title="__('site.page_title.worksheets')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-500 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="mx-auto max-w-4xl text-center relative z-10">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-2 rounded-full bg-yellow-300 px-5 py-2.5 text-base font-bold text-blue-900 hover:bg-yellow-400 mb-6 transition-all hover:scale-110 shadow-lg border-4 border-white">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-3 rounded-full bg-white px-6 py-3 text-lg font-black text-teal-600 mb-6 shadow-xl border-4 border-yellow-300">
                <span class="text-3xl">📄</span> {{ __('site.sidebar.worksheets') ?? 'Worksheets' }}
            </div>
            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-6" style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);">
                {{ __('site.worksheets.title') }}
            </h1>
            <p class="text-xl text-white font-bold max-w-xl mx-auto drop-shadow-lg">
                {{ __('site.worksheets.subtitle') }}
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 px-4 bg-gradient-to-br from-teal-50 via-emerald-50 to-cyan-50 dark:bg-slate-900 min-h-[60vh] relative"
        x-data="{ activeLevel: 'all' }"
    >
        <div class="absolute top-20 right-20 w-48 h-48 bg-teal-200 rounded-full opacity-20 blur-3xl"></div>
        <div class="mx-auto max-w-6xl">

            @if($grouped->isEmpty())
                {{-- Empty state --}}
                <div class="text-center py-20 bg-white rounded-[3rem] border-8 border-teal-300 shadow-2xl mx-auto max-w-2xl dark:bg-slate-900 dark:border-emerald-400">
                    <div class="text-9xl mb-6">📄</div>
                    <h2 class="text-3xl font-black text-teal-600 mb-4 dark:text-teal-400">{{ __('site.worksheets.empty_title') }}</h2>
                    <p class="text-lg text-slate-700 font-medium max-w-sm mx-auto dark:text-slate-200">
                        {{ __('site.worksheets.empty_body') }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-emerald-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
                    >
                        📅 {{ __('site.cta.book_free_assessment') }}
                    </a>
                </div>
            @else
                @php
                    $levelLabels = [
                        'beginner'     => __('site.worksheets.level_beginner'),
                        'intermediate' => __('site.worksheets.level_intermediate'),
                        'advanced'     => __('site.worksheets.level_advanced'),
                        'general'      => __('site.worksheets.level_general'),
                    ];
                    $allLevels = $grouped->keys()->toArray();
                @endphp

                {{-- Level filter tabs --}}
                <div class="flex flex-wrap gap-3 mb-12">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all' ? 'bg-teal-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-white text-teal-600 border-4 border-teal-300 hover:bg-teal-50 dark:bg-slate-800 dark:text-teal-400 dark:border-teal-500'"
                        class="rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg"
                    >{{ __('site.worksheets.filter_all') }}</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}' ? 'bg-teal-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-white text-teal-600 border-4 border-teal-300 hover:bg-teal-50 dark:bg-slate-800 dark:text-teal-400 dark:border-teal-500'"
                            class="rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Worksheets grouped by level --}}
                @foreach($grouped as $level => $worksheets)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="mb-16">
                        <h2 class="text-2xl font-black text-teal-600 dark:text-teal-400 mb-8 flex items-center gap-3">
                            <span class="w-3 h-8 rounded-full bg-gradient-to-b from-teal-400 to-emerald-500 inline-block shadow-lg"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($worksheets as $worksheet)
                                <div class="group bg-white dark:bg-slate-800 rounded-[2rem] shadow-2xl border-6 border-teal-300 dark:border-emerald-400 overflow-hidden hover:shadow-emerald-500/40 transition-all hover:-translate-y-3 hover:rotate-1 flex flex-col">

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
                                    <div class="p-6 flex-1 flex flex-col">
                                        @if($worksheet->topic($lang))
                                            <span class="inline-block mb-3 rounded-full bg-teal-400 text-white text-sm font-black px-4 py-1.5 shadow-lg border-2 border-white self-start">
                                                {{ $worksheet->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="font-extrabold text-slate-900 dark:text-slate-100 text-lg leading-snug flex-1">
                                            {{ $worksheet->title($lang) }}
                                        </h3>
                                        @if($worksheet->description($lang))
                                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2 font-medium">
                                                {{ $worksheet->description($lang) }}
                                            </p>
                                        @endif

                                        {{-- Download button --}}
                                        <div class="mt-5">
                                            @if($worksheet->file_path)
                                                <a
                                                    href="{{ Storage::url($worksheet->file_path) }}"
                                                    target="_blank"
                                                    download
                                                    class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-5 py-3 text-sm font-bold text-white hover:shadow-emerald-500/50 transition-all hover:scale-110 shadow-xl border-4 border-white"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    {{ __('site.worksheets.download_pdf') }}
                                                </a>
                                            @else
                                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-5 py-3 text-sm font-bold text-slate-500 dark:bg-slate-700 dark:text-slate-400">
                                                    {{ __('site.worksheets.coming_soon') }}
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
    <section class="bg-gradient-to-br from-teal-100 via-emerald-50 to-cyan-100 dark:from-slate-900 dark:to-slate-800 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-10 right-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="mx-auto max-w-2xl text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-black text-teal-600 dark:text-teal-400 mb-4" style="text-shadow: 2px 2px 0px rgba(16, 185, 129, 0.3);">{{ __('site.worksheets.cta_title') }}</h2>
            <p class="mt-4 text-xl text-slate-700 dark:text-slate-200 font-medium">{{ __('site.worksheets.cta_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-10 py-5 text-xl font-black text-white shadow-2xl hover:shadow-emerald-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
