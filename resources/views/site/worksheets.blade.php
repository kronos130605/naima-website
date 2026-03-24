<x-site-layout :title="__('site.page_title.worksheets')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php
        $lang = $locale === 'fr' ? 'fr' : 'en';

        $designTheme = auth()->check()
            ? auth()->user()->getThemePreference()
            : \App\Models\SiteSetting::get('default_theme', 'new');
        $isNewDesign = $designTheme === 'new';
    @endphp

    {{-- Hero --}}
    <section class="{{ $isNewDesign ? 'bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-500 py-20 px-4 relative overflow-hidden' : 'bg-gradient-to-br from-teal-600 via-emerald-600 to-cyan-700 py-16 px-4' }}">
        @if($isNewDesign)
            <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        @endif

        <div class="mx-auto max-w-4xl text-center {{ $isNewDesign ? 'relative z-10' : '' }}">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="{{ $isNewDesign ? 'inline-flex items-center gap-2 rounded-full bg-yellow-300 px-5 py-2.5 text-base font-bold text-blue-900 hover:bg-yellow-400 mb-6 transition-all hover:scale-110 shadow-lg border-4 border-white' : 'inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors' }}">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="{{ $isNewDesign ? 'inline-flex items-center gap-3 rounded-full bg-white px-6 py-3 text-lg font-black text-teal-600 mb-6 shadow-xl border-4 border-yellow-300' : 'inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5' }}">
                @if($isNewDesign)
                    <span class="text-3xl">📄</span>
                @else
                    📄
                @endif
                {{ __('site.sidebar.worksheets') ?? 'Worksheets' }}
            </div>
            <h1 class="{{ $isNewDesign ? 'text-4xl sm:text-5xl font-black text-white leading-tight mb-6' : 'text-3xl sm:text-4xl font-extrabold text-white leading-tight' }}" @if($isNewDesign) style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);" @endif>
                {{ __('site.worksheets.title') }}
            </h1>
            <p class="{{ $isNewDesign ? 'text-xl text-white font-bold max-w-xl mx-auto drop-shadow-lg' : 'mt-4 text-lg text-teal-100 max-w-xl mx-auto' }}">
                {{ __('site.worksheets.subtitle') }}
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="{{ $isNewDesign ? 'py-16 px-4 bg-gradient-to-br from-teal-50 via-emerald-50 to-cyan-50 dark:bg-slate-900 min-h-[60vh] relative' : 'py-12 px-4 bg-slate-50 dark:bg-slate-900 min-h-[60vh]' }}"
        x-data="{ activeLevel: 'all' }"
    >
        @if($isNewDesign)
            <div class="absolute top-20 right-20 w-48 h-48 bg-teal-200 rounded-full opacity-20 blur-3xl"></div>
        @endif
        <div class="mx-auto max-w-6xl">

            @if($grouped->isEmpty())
                {{-- Empty state --}}
                <div class="{{ $isNewDesign ? 'text-center py-20 bg-white rounded-[3rem] border-8 border-teal-300 shadow-2xl mx-auto max-w-2xl dark:bg-slate-900 dark:border-emerald-400' : 'text-center py-20' }}">
                    <div class="{{ $isNewDesign ? 'text-9xl mb-6' : 'text-7xl mb-6' }}">📄</div>
                    <h2 class="{{ $isNewDesign ? 'text-3xl font-black text-teal-600 mb-4 dark:text-teal-400' : 'text-xl font-bold text-slate-800 dark:text-slate-100 mb-2' }}">{{ __('site.worksheets.empty_title') }}</h2>
                    <p class="{{ $isNewDesign ? 'text-lg text-slate-700 font-medium max-w-sm mx-auto dark:text-slate-200' : 'text-slate-500 dark:text-slate-400 max-w-sm mx-auto' }}">
                        {{ __('site.worksheets.empty_body') }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="{{ $isNewDesign ? 'mt-8 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-emerald-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white' : 'mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]' }}"
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
                <div class="{{ $isNewDesign ? 'flex flex-wrap gap-3 mb-12' : 'flex flex-wrap gap-2 mb-10' }}">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all'
                            ? '{{ $isNewDesign ? 'bg-teal-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-teal-600 text-white border-teal-600' }}'
                            : '{{ $isNewDesign ? 'bg-white text-teal-600 border-4 border-teal-300 hover:bg-teal-50 dark:bg-slate-800 dark:text-teal-400 dark:border-teal-500' : 'bg-white text-slate-600 border-slate-200 hover:border-teal-300 hover:text-teal-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600' }}'"
                        class="{{ $isNewDesign ? 'rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg' : 'rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors' }}"
                    >{{ __('site.worksheets.filter_all') }}</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}'
                                ? '{{ $isNewDesign ? 'bg-teal-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-teal-600 text-white border-teal-600' }}'
                                : '{{ $isNewDesign ? 'bg-white text-teal-600 border-4 border-teal-300 hover:bg-teal-50 dark:bg-slate-800 dark:text-teal-400 dark:border-teal-500' : 'bg-white text-slate-600 border-slate-200 hover:border-teal-300 hover:text-teal-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600' }}'"
                            class="{{ $isNewDesign ? 'rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg' : 'rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors' }}"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Worksheets grouped by level --}}
                @foreach($grouped as $level => $worksheets)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="{{ $isNewDesign ? 'mb-16' : 'mb-12' }}">
                        <h2 class="{{ $isNewDesign ? 'text-2xl font-black text-teal-600 dark:text-teal-400 mb-8 flex items-center gap-3' : 'text-lg font-bold text-slate-800 dark:text-slate-100 mb-5 flex items-center gap-2' }}">
                            <span class="{{ $isNewDesign ? 'w-3 h-8 rounded-full bg-gradient-to-b from-teal-400 to-emerald-500 inline-block shadow-lg' : 'w-1.5 h-6 rounded-full bg-teal-500 inline-block' }}"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="{{ $isNewDesign ? 'grid gap-8 sm:grid-cols-2 lg:grid-cols-3' : 'grid gap-5 sm:grid-cols-2 lg:grid-cols-3' }}">
                            @foreach($worksheets as $worksheet)
                                <div class="{{ $isNewDesign ? 'group bg-white dark:bg-slate-800 rounded-[2rem] shadow-2xl border-6 border-teal-300 dark:border-emerald-400 overflow-hidden hover:shadow-emerald-500/40 transition-all hover:-translate-y-3 hover:rotate-1 flex flex-col' : 'group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow flex flex-col' }}">

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
                                    <div class="{{ $isNewDesign ? 'p-6 flex-1 flex flex-col' : 'p-4 flex-1 flex flex-col' }}">
                                        @if($worksheet->topic($lang))
                                            <span class="{{ $isNewDesign ? 'inline-block mb-3 rounded-full bg-teal-400 text-white text-sm font-black px-4 py-1.5 shadow-lg border-2 border-white self-start' : 'inline-block mb-2 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-xs font-bold px-2.5 py-0.5 self-start' }}">
                                                {{ $worksheet->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="{{ $isNewDesign ? 'font-extrabold text-slate-900 dark:text-slate-100 text-lg leading-snug flex-1' : 'font-semibold text-slate-900 dark:text-slate-100 text-sm leading-snug flex-1' }}">
                                            {{ $worksheet->title($lang) }}
                                        </h3>
                                        @if($worksheet->description($lang))
                                            <p class="{{ $isNewDesign ? 'mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2 font-medium' : 'mt-1.5 text-xs text-slate-500 dark:text-slate-400 line-clamp-2' }}">
                                                {{ $worksheet->description($lang) }}
                                            </p>
                                        @endif

                                        {{-- Download button --}}
                                        <div class="{{ $isNewDesign ? 'mt-5' : 'mt-4' }}">
                                            @if($worksheet->file_path)
                                                <a
                                                    href="{{ Storage::url($worksheet->file_path) }}"
                                                    target="_blank"
                                                    download
                                                    class="{{ $isNewDesign ? 'inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-5 py-3 text-sm font-bold text-white hover:shadow-emerald-500/50 transition-all hover:scale-110 shadow-xl border-4 border-white' : 'inline-flex items-center gap-1.5 rounded-lg bg-teal-600 px-4 py-2 text-xs font-semibold text-white hover:bg-teal-700 transition-colors shadow-sm' }}"
                                                >
                                                    <svg class="{{ $isNewDesign ? 'w-4 h-4' : 'w-3.5 h-3.5' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" @if($isNewDesign) stroke-width="3" @else stroke-width="2" @endif><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    {{ __('site.worksheets.download_pdf') }}
                                                </a>
                                            @else
                                                <span class="{{ $isNewDesign ? 'inline-flex items-center gap-2 rounded-full bg-slate-200 px-5 py-3 text-sm font-bold text-slate-500 dark:bg-slate-700 dark:text-slate-400' : 'inline-flex items-center gap-1.5 rounded-lg bg-slate-100 dark:bg-slate-700 px-4 py-2 text-xs font-semibold text-slate-400 dark:text-slate-500' }}">
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
    <section class="{{ $isNewDesign ? 'bg-gradient-to-br from-teal-100 via-emerald-50 to-cyan-100 dark:from-slate-900 dark:to-slate-800 py-20 px-4 relative overflow-hidden' : 'bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4' }}">
        @if($isNewDesign)
            <div class="absolute top-10 right-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        @endif
        <div class="mx-auto max-w-2xl text-center {{ $isNewDesign ? 'relative z-10' : '' }}">
            <h2 class="{{ $isNewDesign ? 'text-3xl md:text-4xl font-black text-teal-600 dark:text-teal-400 mb-4' : 'text-2xl font-extrabold text-slate-900 dark:text-white' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(16, 185, 129, 0.3);" @endif>{{ __('site.worksheets.cta_title') }}</h2>
            <p class="{{ $isNewDesign ? 'mt-4 text-xl text-slate-700 dark:text-slate-200 font-medium' : 'mt-3 text-slate-600 dark:text-slate-300' }}">{{ __('site.worksheets.cta_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="{{ $isNewDesign ? 'mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-teal-500 to-emerald-600 px-10 py-5 text-xl font-black text-white shadow-2xl hover:shadow-emerald-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white' : 'mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]' }}"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
