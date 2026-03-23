<section id="programs" class="mx-auto max-w-6xl px-4 py-20 relative">
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-200 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="text-center mb-16 relative z-10">
        <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
            {{ $programs['title'] }}
        </h2>
        <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">
            {{ __('site.programs.subtitle') }}
        </p>
    </div>
    <div class="grid gap-8 md:grid-cols-3 relative z-10">
        @foreach(($programs['items'] ?? []) as $index => $program)
            @php
                $gradients = [
                    'from-yellow-400 to-orange-400',
                    'from-blue-500 to-indigo-500',
                    'from-purple-500 to-pink-500',
                ];
                $bgColors = [
                    'bg-yellow-100 border-yellow-400',
                    'bg-blue-100 border-blue-400',
                    'bg-purple-100 border-purple-400',
                ];
                $icons = ['🌱', '📘', '🏆'];
                $grad = $gradients[$index % count($gradients)];
                $bg = $bgColors[$index % count($bgColors)];
                $icon = $icons[$index % count($icons)];
            @endphp
            <div class="group relative rounded-[2rem] border-6 {{ $bg }} p-8 shadow-2xl hover:shadow-purple-500/30 transition-all hover:-translate-y-3 hover:rotate-2">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br {{ $grad }} flex items-center justify-center text-white text-5xl mb-6 shadow-xl border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all">
                    {{ $icon }}
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100 mb-2">{{ $program['title'] }}</h3>
                <p class="text-base font-bold text-purple-600 dark:text-purple-400 mb-4">{{ $program['grades'] }}</p>
                <p class="text-slate-700 dark:text-slate-200 leading-relaxed font-medium">{{ $program['body'] }}</p>
                @if(!empty($program['tags']))
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($program['tags'] as $tag)
                            <span class="inline-flex items-center rounded-full bg-white border-2 border-slate-300 px-4 py-1.5 text-sm font-bold text-slate-700 shadow-md dark:bg-slate-800 dark:border-slate-600 dark:text-slate-200">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
