<section id="programs" class="mx-auto max-w-6xl px-4 py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
            {{ $programs['title'] }}
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300">
            {{ __('site.programs.subtitle') }}
        </p>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
        @foreach(($programs['items'] ?? []) as $index => $program)
            @php
                $gradients = [
                    'from-yellow-400 to-orange-400',
                    'from-blue-500 to-indigo-500',
                    'from-purple-500 to-pink-500',
                ];
                $bgLights = [
                    'from-yellow-50 to-orange-50 border-yellow-200',
                    'from-blue-50 to-indigo-50 border-blue-200',
                    'from-purple-50 to-pink-50 border-purple-200',
                ];
                $icons = ['🌱', '📘', '🏆'];
                $grad = $gradients[$index % count($gradients)];
                $bg = $bgLights[$index % count($bgLights)];
                $icon = $icons[$index % count($icons)];
            @endphp
            <div class="group relative rounded-3xl border bg-gradient-to-br {{ $bg }} p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-r {{ $grad }} flex items-center justify-center text-white text-3xl mb-6 shadow-lg">
                    {{ $icon }}
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-2">{{ $program['title'] }}</h3>
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-4">{{ $program['grades'] }}</p>
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $program['body'] }}</p>
                @if(!empty($program['tags']))
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($program['tags'] as $tag)
                            <span class="inline-flex items-center rounded-full bg-white/80 border border-slate-200 px-3 py-1 text-xs font-medium text-slate-700 dark:bg-slate-900/60 dark:border-slate-700 dark:text-slate-300">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
