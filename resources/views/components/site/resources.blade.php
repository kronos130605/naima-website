<section id="resources" class="mx-auto max-w-6xl px-4 py-20 relative">
    <div class="absolute top-0 right-10 w-72 h-72 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="text-center mb-16 relative z-10">
        <div class="inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 mb-6 shadow-lg border-4 border-white dark:bg-yellow-300">
            ✨ {{ __('site.resources.badge') }}
        </div>
        <h2 class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400" style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);">
            {{ $resources['title'] }}
        </h2>
        <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">
            {{ __('site.resources.subtitle') }}
        </p>
    </div>

    @if(!empty($resources['items']))
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 relative z-10">
            @foreach($resources['items'] as $item)
                @php
                    $typeColor = match($item['type'] ?? 'pdf') {
                        'mindmap' => 'bg-purple-400 text-white border-purple-600',
                        'exercise' => 'bg-blue-400 text-white border-blue-600',
                        'video'    => 'bg-red-400 text-white border-red-600',
                        default    => 'bg-green-400 text-white border-green-600',
                    };
                    $typeIcon = match($item['type'] ?? 'pdf') {
                        'mindmap'  => '🗺️',
                        'exercise' => '✏️',
                        'video'    => '▶️',
                        default    => '📄',
                    };
                @endphp
                <div class="group relative bg-white rounded-[2rem] shadow-2xl border-6 border-purple-300 p-6 hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-400 flex items-center justify-center text-3xl flex-shrink-0 shadow-lg border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all">
                            {{ $typeIcon }}
                        </div>
                        <span class="inline-flex items-center rounded-full border-2 px-3 py-1 text-xs font-bold shadow-md {{ $typeColor }}">
                            {{ $item['type'] ?? 'PDF' }}
                        </span>
                    </div>
                    <h3 class="font-extrabold text-slate-900 mb-2 text-lg dark:text-slate-100">{{ $item['title'] }}</h3>
                    @if(!empty($item['subject']))
                        <p class="text-sm text-purple-600 font-bold dark:text-purple-400 mb-4">{{ $item['subject'] }}</p>
                    @endif
                    @if(!empty($item['url']))
                        <a
                            href="{{ $item['url'] }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-2 text-base font-bold text-blue-600 hover:text-blue-800 transition-all hover:scale-105 dark:text-blue-400 dark:hover:text-blue-300"
                        >
                            {{ __('site.resources.download') }}
                            <span aria-hidden="true" class="text-xl">↓</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-[3rem] border-8 border-yellow-300 shadow-2xl relative z-10 dark:bg-slate-900 dark:border-purple-400">
            <div class="text-8xl mb-6">📚</div>
            <p class="text-2xl font-extrabold text-blue-600 mb-3 dark:text-blue-400">{{ __('site.resources.coming_soon_title') }}</p>
            <p class="text-slate-700 font-medium text-lg dark:text-slate-200 max-w-sm mx-auto">{{ __('site.resources.coming_soon_body') }}</p>
            <a
                href="#contact"
                class="mt-8 inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
            >
                🔔 {{ __('site.resources.notify_me') }}
            </a>
        </div>
    @endif
</section>
