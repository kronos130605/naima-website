<x-site-layout :title="__('site.page_title.videos')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-rose-600 via-pink-600 to-purple-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/80 hover:text-white mb-5 transition-colors">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                🎬 {{ __('site.videos.badge') ?? 'Videos' }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ __('site.videos.title') ?? 'French Learning Videos' }}
            </h1>
            <p class="mt-4 text-lg text-rose-100 max-w-xl mx-auto">
                {{ __('site.videos.subtitle') ?? 'Watch short, focused lessons to reinforce what you learn in session.' }}
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
                    <div class="text-7xl mb-6">🎬</div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">{{ __('site.videos.empty_title') }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                        {{ __('site.videos.empty_body') }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
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
                <div class="flex flex-wrap gap-2 mb-10">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all' ? 'bg-rose-600 text-white border-rose-600' : 'bg-white text-slate-600 border-slate-200 hover:border-rose-300 hover:text-rose-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600'"
                        class="rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors"
                    >{{ __('site.videos.filter_all') }}</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}' ? 'bg-rose-600 text-white border-rose-600' : 'bg-white text-slate-600 border-slate-200 hover:border-rose-300 hover:text-rose-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600'"
                            class="rounded-full px-4 py-1.5 text-sm font-semibold border transition-colors"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Videos grouped by level --}}
                @foreach($grouped as $level => $videos)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="mb-12">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 rounded-full bg-rose-500 inline-block"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($videos as $video)
                                <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow"
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
                                                    <div class="w-14 h-14 rounded-full bg-red-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                        <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
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
                                    <div class="p-4">
                                        @if($video->topic($lang))
                                            <span class="inline-block mb-2 rounded-full bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 text-xs font-bold px-2.5 py-0.5">
                                                {{ $video->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="font-semibold text-slate-900 dark:text-slate-100 text-sm leading-snug">
                                            {{ $video->title($lang) }}
                                        </h3>
                                        @if($video->description($lang))
                                            <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
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
    <section class="bg-gradient-to-br from-rose-50 to-pink-50 dark:from-slate-900 dark:to-slate-800 py-16 px-4">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('site.videos.cta_title') }}</h2>
            <p class="mt-3 text-slate-600 dark:text-slate-300">{{ __('site.videos.cta_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-8 py-3 text-base font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
