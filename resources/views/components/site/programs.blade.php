@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="programs" class="{{ $isNewDesign ? 'mx-auto max-w-6xl px-4 py-20 relative' : 'mx-auto max-w-6xl px-4 py-20' }}">
    @if($isNewDesign)
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-200 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'text-center mb-16 relative z-10' : 'text-center mb-12' }}">
        <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);" @endif>
            {{ $programs['title'] }}
        </h2>
        <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300' }}">
            {{ __('site.programs.subtitle') }}
        </p>
    </div>
    <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-3 relative z-10' : 'grid gap-6 md:grid-cols-3' }}">
        @foreach(($programs['items'] ?? []) as $index => $program)
            @php
                $gradients = [
                    'from-yellow-400 to-orange-400',
                    'from-blue-500 to-indigo-500',
                    'from-purple-500 to-pink-500',
                ];
                $bg = $isNewDesign
                    ? [
                        'bg-yellow-100 border-yellow-400 dark:bg-slate-900 dark:border-yellow-500/40',
                        'bg-blue-100 border-blue-400 dark:bg-slate-900 dark:border-blue-500/40',
                        'bg-purple-100 border-purple-400 dark:bg-slate-900 dark:border-purple-500/40',
                    ]
                    : [
                        'from-yellow-50 to-orange-50 border-yellow-200 dark:from-slate-900 dark:to-slate-800 dark:border-slate-700',
                        'from-blue-50 to-indigo-50 border-blue-200 dark:from-slate-900 dark:to-slate-800 dark:border-slate-700',
                        'from-purple-50 to-pink-50 border-purple-200 dark:from-slate-900 dark:to-slate-800 dark:border-slate-700',
                    ];
                $icons = ['🌱', '📘', '🏆'];
                $grad = $gradients[$index % count($gradients)];
                $bg = $bg[$index % count($bg)];
                $icon = $icons[$index % count($icons)];
            @endphp
            <div class="group relative {{ $isNewDesign ? 'rounded-[2rem] border-6' : 'rounded-3xl border bg-gradient-to-br' }} {{ $bg }} p-8 {{ $isNewDesign ? 'shadow-2xl hover:shadow-purple-500/30 transition-all hover:-translate-y-3 hover:rotate-2' : 'shadow-lg hover:shadow-xl transition-all hover:-translate-y-1' }}">
                <div class="{{ $isNewDesign ? 'w-20 h-20 rounded-3xl bg-gradient-to-br' : 'w-16 h-16 rounded-2xl bg-gradient-to-r' }} {{ $grad }} flex items-center justify-center text-white {{ $isNewDesign ? 'text-5xl' : 'text-3xl' }} mb-6 {{ $isNewDesign ? 'shadow-xl border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all' : 'shadow-lg' }}">
                    {{ $icon }}
                </div>
                <h3 class="{{ $isNewDesign ? 'text-2xl font-extrabold' : 'text-xl font-bold' }} text-slate-900 dark:text-slate-100 mb-2">{{ $program['title'] }}</h3>
                <p class="{{ $isNewDesign ? 'text-base font-bold text-purple-600 dark:text-purple-400' : 'text-sm font-semibold text-slate-500 dark:text-slate-400' }} mb-4">{{ $program['grades'] }}</p>
                <p class="{{ $isNewDesign ? 'text-slate-700 dark:text-slate-200 leading-relaxed font-medium' : 'text-slate-600 dark:text-slate-300 leading-relaxed' }}">{{ $program['body'] }}</p>
                @if(!empty($program['tags']))
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($program['tags'] as $tag)
                            <span class="{{ $isNewDesign ? 'inline-flex items-center rounded-full bg-white border-2 border-slate-300 px-4 py-1.5 text-sm font-bold text-slate-700 shadow-md dark:bg-slate-800 dark:border-slate-600 dark:text-slate-200' : 'inline-flex items-center rounded-full bg-white/80 border border-slate-200 px-3 py-1 text-xs font-medium text-slate-700 dark:bg-slate-900/60 dark:border-slate-700 dark:text-slate-300' }}">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
