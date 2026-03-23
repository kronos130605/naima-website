<x-site-layout :title="__('site.page_title.videos')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-red-400 via-pink-400 to-purple-500 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="mx-auto max-w-4xl text-center relative z-10">
            <a href="{{ route('site.home', ['locale' => $locale]) }}" class="inline-flex items-center gap-2 rounded-full bg-yellow-300 px-5 py-2.5 text-base font-bold text-blue-900 hover:bg-yellow-400 mb-6 transition-all hover:scale-110 shadow-lg border-4 border-white">
                ← {{ __('site.nav.home') ?? 'Home' }}
            </a>
            <div class="inline-flex items-center gap-3 rounded-full bg-white px-6 py-3 text-lg font-black text-pink-600 mb-6 shadow-xl border-4 border-yellow-300">
                <span class="text-3xl">🎬</span> {{ __('site.videos.badge') ?? 'Videos' }}
            </div>
            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-6" style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);">
                {{ __('site.videos.title') ?? 'French Learning Videos' }}
            </h1>
            <p class="text-xl text-white font-bold max-w-xl mx-auto drop-shadow-lg">
                {{ __('site.videos.subtitle') ?? 'Watch short, focused lessons to reinforce what you learn in session.' }}
            </p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 px-4 bg-gradient-to-br from-yellow-50 via-pink-50 to-purple-50 dark:bg-slate-900 min-h-[60vh] relative"
        x-data="{ activeLevel: 'all' }"
    >
        <div class="absolute top-20 right-20 w-48 h-48 bg-pink-200 rounded-full opacity-20 blur-3xl"></div>
        <div class="mx-auto max-w-6xl">

            @if($grouped->isEmpty())
                {{-- Empty state --}}
                <div class="text-center py-20 bg-white rounded-[3rem] border-8 border-pink-300 shadow-2xl mx-auto max-w-2xl dark:bg-slate-900 dark:border-purple-400">
                    <div class="text-9xl mb-6">🎬</div>
                    <h2 class="text-3xl font-black text-pink-600 mb-4 dark:text-pink-400">{{ __('site.videos.empty_title') }}</h2>
                    <p class="text-lg text-slate-700 font-medium max-w-sm mx-auto dark:text-slate-200">
                        {{ __('site.videos.empty_body') }}
                    </p>
                    <a
                        href="{{ route('site.booking', ['locale' => $locale]) }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
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
                <div class="flex flex-wrap gap-3 mb-12">
                    <button
                        @click="activeLevel = 'all'"
                        :class="activeLevel === 'all' ? 'bg-pink-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-white text-pink-600 border-4 border-pink-300 hover:bg-pink-50 dark:bg-slate-800 dark:text-pink-400 dark:border-pink-500'"
                        class="rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg"
                    >{{ __('site.videos.filter_all') }}</button>
                    @foreach($allLevels as $lvl)
                        <button
                            @click="activeLevel = '{{ $lvl }}'"
                            :class="activeLevel === '{{ $lvl }}' ? 'bg-pink-500 text-white border-4 border-white shadow-xl scale-110' : 'bg-white text-pink-600 border-4 border-pink-300 hover:bg-pink-50 dark:bg-slate-800 dark:text-pink-400 dark:border-pink-500'"
                            class="rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg"
                        >{{ $levelLabels[$lvl] ?? $lvl }}</button>
                    @endforeach
                </div>

                {{-- Videos grouped by level --}}
                @foreach($grouped as $level => $videos)
                    <div x-show="activeLevel === 'all' || activeLevel === '{{ $level }}'" class="mb-16">
                        <h2 class="text-2xl font-black text-pink-600 dark:text-pink-400 mb-8 flex items-center gap-3">
                            <span class="w-3 h-8 rounded-full bg-gradient-to-b from-pink-400 to-purple-500 inline-block shadow-lg"></span>
                            {{ $levelLabels[$level] ?? $level }}
                        </h2>
                        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($videos as $video)
                                <div class="group bg-white dark:bg-slate-800 rounded-[2rem] shadow-2xl border-6 border-pink-300 dark:border-purple-400 overflow-hidden hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1"
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
                                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center shadow-2xl group-hover:scale-125 transition-all border-4 border-white">
                                                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
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
                                    <div class="p-6">
                                        @if($video->topic($lang))
                                            <span class="inline-block mb-3 rounded-full bg-pink-400 text-white text-sm font-black px-4 py-1.5 shadow-lg border-2 border-white">
                                                {{ $video->topic($lang) }}
                                            </span>
                                        @endif
                                        <h3 class="font-extrabold text-slate-900 dark:text-slate-100 text-lg leading-snug">
                                            {{ $video->title($lang) }}
                                        </h3>
                                        @if($video->description($lang))
                                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2 font-medium">
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
    <section class="bg-gradient-to-br from-pink-100 via-purple-50 to-blue-100 dark:from-slate-900 dark:to-slate-800 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="mx-auto max-w-2xl text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-black text-purple-600 dark:text-purple-400 mb-4" style="text-shadow: 2px 2px 0px rgba(236, 72, 153, 0.3);">{{ __('site.videos.cta_title') }}</h2>
            <p class="mt-4 text-xl text-slate-700 dark:text-slate-200 font-medium">{{ __('site.videos.cta_body') }}</p>
            <a
                href="{{ route('site.booking', ['locale' => $locale]) }}"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 px-10 py-5 text-xl font-black text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
            >
                📅 {{ __('site.cta.book_free_assessment') }}
            </a>
        </div>
    </section>

</x-site-layout>
