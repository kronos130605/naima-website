<x-site-layout :title="__('site.page_title.videos')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php
        $lang = $locale === 'fr' ? 'fr' : 'en';

        $designTheme = auth()->check()
            ? auth()->user()->getThemePreference()
            : \App\Models\SiteSetting::get('default_theme', 'new');
        $isNewDesign = $designTheme === 'new';
    @endphp

    {{-- Hero --}}
    <section class="{{ $isNewDesign ? 'bg-gradient-to-br from-red-400 via-pink-400 to-purple-500 py-20 px-4 relative overflow-hidden' : 'bg-gradient-to-br from-rose-600 via-pink-600 to-purple-700 py-16 px-4' }}">
        @if($isNewDesign)
            <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        @endif

        <div class="mx-auto max-w-4xl text-center {{ $isNewDesign ? 'relative z-10' : '' }}">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="{{ $isNewDesign ? 'inline-flex items-center gap-2 rounded-full bg-yellow-300 px-5 py-2.5 text-base font-bold text-blue-900 hover:bg-yellow-400 mb-6 transition-all hover:scale-110 shadow-lg border-4 border-white' : 'inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors' }}">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="{{ $isNewDesign ? 'inline-flex items-center gap-3 rounded-full bg-white px-6 py-3 text-lg font-black text-pink-600 mb-6 shadow-xl border-4 border-yellow-300' : 'inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5' }}">
                @if($isNewDesign)
                    <span class="text-3xl">🎬</span>
                @else
                    🎬
                @endif
                {{ __('site.videos.badge') ?? 'Videos' }}
            </div>
            <h1 class="{{ $isNewDesign ? 'text-4xl sm:text-5xl font-black text-white leading-tight mb-6' : 'text-3xl sm:text-4xl font-extrabold text-white leading-tight' }}" @if($isNewDesign) style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);" @endif>
                {{ __('site.videos.title') ?? 'French Learning Videos' }}
            </h1>
            <p class="{{ $isNewDesign ? 'text-xl text-white font-bold max-w-xl mx-auto drop-shadow-lg' : 'mt-4 text-lg text-rose-100 max-w-xl mx-auto' }}">
                {{ __('site.videos.subtitle') ?? 'Watch short, focused lessons to reinforce what you learn in session.' }}
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="{{ $isNewDesign ? 'py-16 px-4 bg-gradient-to-br from-yellow-50 via-pink-50 to-purple-50 dark:bg-slate-900 min-h-[60vh] relative' : 'py-12 px-4 bg-slate-50 dark:bg-slate-900 min-h-[60vh]' }}"
        x-data="{ activeLevel: 'all' }"
    >
        @if($isNewDesign)
            <div class="absolute top-20 right-20 w-48 h-48 bg-pink-200 rounded-full opacity-20 blur-3xl"></div>
        @endif
        <div class="mx-auto max-w-6xl">

            @if($grouped->isEmpty())
                {{-- Empty state --}}
                <div class="{{ $isNewDesign ? 'text-center py-20 bg-white rounded-[3rem] border-8 border-pink-300 shadow-2xl mx-auto max-w-2xl dark:bg-slate-900 dark:border-purple-400' : 'text-center py-20' }}">
                    <div class="{{ $isNewDesign ? 'text-9xl mb-6' : 'text-7xl mb-6' }}">🎬</div>
                    <h2 class="{{ $isNewDesign ? 'text-3xl font-black text-pink-600 mb-4 dark:text-pink-400' : 'text-xl font-bold text-slate-800 dark:text-slate-100 mb-2' }}">{{ __('site.videos.empty_title') }}</h2>
                    <p class="{{ $isNewDesign ? 'text-lg text-slate-700 font-medium max-w-sm mx-auto dark:text-slate-200' : 'text-slate-500 dark:text-slate-400 max-w-sm mx-auto' }}">
                        {{ __('site.videos.empty_body') }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="{{ $isNewDesign ? 'mt-8 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white' : 'mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]' }}"
                    >
                        📅 {{ __('site.cta.book_free_assessment') }}
                    </a>
                </div>
            @else
                @php
                    $levelLabels = [
                        'beginner'     => __('site.videos.level_beginner'),
                        'intermediate' => __('site.videos.level_intermediate'),
                        'advanced'     => __('site.videos.level_advanced'),
                        'general'      => __('site.videos.level_general'),
                    ];
                    $allLevels = $grouped->keys()->toArray();
                @endphp

                {{-- Level filter tabs --}}
                <div class="{{ $isNewDesign ? 'flex flex-wrap gap-3 mb-12' : 'flex flex-wrap gap-2 mb-10' }}">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all'
                            ? '{{ $isNewDesign ? 'bg-pink-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-rose-600 text-white border-rose-600' }}'
                            : '{{ $isNewDesign ? 'bg-white text-pink-600 border-4 border-pink-300 hover:bg-pink-50 dark:bg-slate-800 dark:text-pink-400 dark:border-pink-500' : 'bg-white text-slate-600 border-slate-200 hover:border-rose-300 hover:text-rose-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600' }}'"
                        class="{{ $isNewDesign ? 'rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg' : 'rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors' }}"
                    >{{ __('site.videos.filter_all') }}</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}'
                                ? '{{ $isNewDesign ? 'bg-pink-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-rose-600 text-white border-rose-600' }}'
                                : '{{ $isNewDesign ? 'bg-white text-pink-600 border-4 border-pink-300 hover:bg-pink-50 dark:bg-slate-800 dark:text-pink-400 dark:border-pink-500' : 'bg-white text-slate-600 border-slate-200 hover:border-rose-300 hover:text-rose-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600' }}'"
                            class="{{ $isNewDesign ? 'rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg' : 'rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors' }}"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Videos grouped by level --}}
                @foreach($grouped as $level => $videos)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="{{ $isNewDesign ? 'mb-16' : 'mb-12' }}">
                        <h2 class="{{ $isNewDesign ? 'text-2xl font-black text-pink-600 dark:text-pink-400 mb-8 flex items-center gap-3' : 'text-lg font-bold text-slate-800 dark:text-slate-100 mb-5 flex items-center gap-2' }}">
                            <span class="{{ $isNewDesign ? 'w-3 h-8 rounded-full bg-gradient-to-b from-pink-400 to-purple-500 inline-block shadow-lg' : 'w-1.5 h-6 rounded-full bg-rose-500 inline-block' }}"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="{{ $isNewDesign ? 'grid gap-8 sm:grid-cols-2 lg:grid-cols-3' : 'grid gap-6 sm:grid-cols-2 lg:grid-cols-3' }}">
                            @foreach($videos as $video)
                                <div class="{{ $isNewDesign ? 'group bg-white dark:bg-slate-800 rounded-[2rem] shadow-2xl border-6 border-pink-300 dark:border-purple-400 overflow-hidden hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1' : 'group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow' }}"
                                    x-data="{ playing: false }"
                                >
                                    {{-- Thumbnail / Embed --}}
                                    <div class="relative aspect-video bg-slate-900 cursor-pointer" @click="playing = true">
                                        <template x-if="!playing">
                                            <div class="absolute inset-0">
                                                <img
                                                    src="{{ $video->thumbnailUrl() }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $video->title($lang) }}"
                                                    loading="lazy"
                                                >
                                                <div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/20 transition-colors">
                                                    <div class="{{ $isNewDesign ? 'w-20 h-20 rounded-full bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center shadow-2xl group-hover:scale-125 transition-all border-4 border-white' : 'w-14 h-14 rounded-full bg-red-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform' }}">
                                                        <svg class="{{ $isNewDesign ? 'w-8 h-8 text-white ml-1' : 'w-6 h-6 text-white ml-1' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="playing">
                                            <iframe
                                                src="{{ $video->embedUrl() }}?autoplay=1"
                                                class="absolute inset-0 w-full h-full"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                            ></iframe>
                                        </template>
                                    </div>

                                    {{-- Info --}}
                                    <div class="{{ $isNewDesign ? 'p-6' : 'p-4' }}">
                                        @if($video->topic($lang))
                                            <span class="{{ $isNewDesign ? 'inline-block mb-3 rounded-full bg-pink-400 text-white text-sm font-black px-4 py-1.5 shadow-lg border-2 border-white' : 'inline-block mb-2 rounded-full bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 text-xs font-bold px-2.5 py-0.5' }}">
                                                {{ $video->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="{{ $isNewDesign ? 'font-extrabold text-slate-900 dark:text-slate-100 text-lg leading-snug' : 'font-semibold text-slate-900 dark:text-slate-100 text-sm leading-snug' }}">
                                            {{ $video->title($lang) }}
                                        </h3>
                                        @if($video->description($lang))
                                            <p class="{{ $isNewDesign ? 'mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2 font-medium' : 'mt-1.5 text-xs text-slate-500 dark:text-slate-400 line-clamp-2' }}">
                                                {{ $video->description($lang) }}
                                            </p>
                                        @endif
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
    <section class="{{ $isNewDesign ? 'bg-gradient-to-br from-pink-100 via-purple-50 to-blue-100 dark:from-slate-900 dark:to-slate-800 py-20 px-4 relative overflow-hidden' : 'bg-gradient-to-br from-rose-50 to-pink-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4' }}">
        @if($isNewDesign)
            <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        @endif
        <div class="mx-auto max-w-2xl text-center {{ $isNewDesign ? 'relative z-10' : '' }}">
            <h2 class="{{ $isNewDesign ? 'text-3xl md:text-4xl font-black text-purple-600 dark:text-purple-400 mb-4' : 'text-2xl font-extrabold text-slate-900 dark:text-white' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(236, 72, 153, 0.3);" @endif>{{ __('site.videos.cta_title') }}</h2>
            <p class="{{ $isNewDesign ? 'mt-4 text-xl text-slate-700 dark:text-slate-200 font-medium' : 'mt-3 text-slate-600 dark:text-slate-300' }}">{{ __('site.videos.cta_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="{{ $isNewDesign ? 'mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 px-10 py-5 text-xl font-black text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white' : 'mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]' }}"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
