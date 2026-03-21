<section id="resources" class="mx-auto max-w-6xl px-4 py-20">
    <div class="text-center mb-12">
        <div class="inline-flex items-center rounded-full bg-gradient-to-r from-yellow-100 to-orange-100 px-4 py-2 text-sm font-semibold text-yellow-800 mb-4">
            {{ __('site.resources.badge') }}
        </div>
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
            {{ $resources['title'] }}
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300">
            {{ __('site.resources.subtitle') }}
        </p>
    </div>

    @if(!empty($resources['items']))
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($resources['items'] as $item)
                @php
                    $typeColor = match($item['type'] ?? 'pdf') {
                        'mindmap' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'exercise' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'video'    => 'bg-red-100 text-red-700 border-red-200',
                        default    => 'bg-green-100 text-green-700 border-green-200',
                    };
                    $typeIcon = match($item['type'] ?? 'pdf') {
                        'mindmap'  => '🗺️',
                        'exercise' => '✏️',
                        'video'    => '▶️',
                        default    => '📄',
                    };
                @endphp
                <div class="group relative bg-white rounded-2xl shadow-lg border border-blue-100 p-6 hover:shadow-xl transition-all hover:-translate-y-0.5 dark:bg-slate-950/70 dark:border-slate-800">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center text-2xl flex-shrink-0">
                            {{ $typeIcon }}
                        </div>
                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium {{ $typeColor }}">
                            {{ $item['type'] ?? 'PDF' }}
                        </span>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1 dark:text-slate-100">{{ $item['title'] }}</h3>
                    @if(!empty($item['subject']))
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">{{ $item['subject'] }}</p>
                    @endif
                    @if(!empty($item['url']))
                        <a
                            href="{{ $item['url'] }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors dark:text-blue-400 dark:hover:text-blue-300"
                        >
                            {{ __('site.resources.download') }}
                            <span aria-hidden="true">↓</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-3xl border border-blue-100 shadow-lg dark:bg-slate-950/70 dark:border-slate-800">
            <div class="text-6xl mb-4">📚</div>
            <p class="text-lg font-semibold text-slate-700 mb-2 dark:text-slate-200">{{ __('site.resources.coming_soon_title') }}</p>
            <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto">{{ __('site.resources.coming_soon_body') }}</p>
            <a
                href="#contact"
                class="mt-6 inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-105"
            >
                {{ __('site.resources.notify_me') }}
            </a>
        </div>
    @endif
</section>
