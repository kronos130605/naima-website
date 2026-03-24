@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="resources" class="{{ $isNewDesign ? 'mx-auto max-w-6xl px-4 py-20 relative' : 'mx-auto max-w-6xl px-4 py-20' }}">
    @if($isNewDesign)
        <div class="absolute top-0 right-10 w-72 h-72 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'text-center mb-16 relative z-10' : 'text-center mb-12' }}">
        <div class="{{
            $isNewDesign
                ? 'inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 mb-6 shadow-lg border-4 border-white dark:bg-yellow-300'
                : 'inline-flex items-center rounded-full bg-gradient-to-r from-yellow-100 to-orange-100 px-4 py-2 text-sm font-semibold text-yellow-800 mb-4'
        }}">
            @if($isNewDesign)
                ✨
            @endif
            {{ __('site.resources.badge') }}
        </div>
        <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);" @endif>
            {{ $resources['title'] }}
        </h2>
        <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300' }}">
            {{ __('site.resources.subtitle') }}
        </p>
    </div>

    @if(!empty($resources['items']))
        <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-2 lg:grid-cols-3 relative z-10' : 'grid gap-6 md:grid-cols-2 lg:grid-cols-3' }}">
            @foreach($resources['items'] as $item)
                @php
                    $typeColor = match($item['type'] ?? 'pdf') {
                        'mindmap' => $isNewDesign ? 'bg-purple-400 text-white border-purple-600' : 'bg-purple-100 text-purple-700 border-purple-200',
                        'exercise' => $isNewDesign ? 'bg-blue-400 text-white border-blue-600' : 'bg-blue-100 text-blue-700 border-blue-200',
                        'video'    => $isNewDesign ? 'bg-red-400 text-white border-red-600' : 'bg-red-100 text-red-700 border-red-200',
                        default    => $isNewDesign ? 'bg-green-400 text-white border-green-600' : 'bg-green-100 text-green-700 border-green-200',
                    };
                    $typeIcon = match($item['type'] ?? 'pdf') {
                        'mindmap'  => '🗺️',
                        'exercise' => '✏️',
                        'video'    => '▶️',
                        default    => '📄',
                    };
                @endphp
                <div class="{{
                    $isNewDesign
                        ? 'group relative bg-white rounded-[2rem] shadow-2xl border-6 border-purple-300 p-6 hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400'
                        : 'group relative bg-white rounded-2xl shadow-lg border border-blue-100 p-6 hover:shadow-xl transition-all hover:-translate-y-0.5 dark:bg-slate-950/70 dark:border-slate-800'
                }}">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="{{
                            $isNewDesign
                                ? 'w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-400 flex items-center justify-center text-3xl flex-shrink-0 shadow-lg border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all'
                                : 'w-12 h-12 rounded-xl bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center text-2xl flex-shrink-0'
                        }}">
                            {{ $typeIcon }}
                        </div>
                        <span class="{{ $isNewDesign ? 'inline-flex items-center rounded-full border-2 px-3 py-1 text-xs font-bold shadow-md' : 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium' }} {{ $typeColor }}">
                            {{ $item['type'] ?? 'PDF' }}
                        </span>
                    </div>
                    <h3 class="{{ $isNewDesign ? 'font-extrabold text-slate-900 mb-2 text-lg dark:text-slate-100' : 'font-bold text-slate-900 mb-1 dark:text-slate-100' }}">{{ $item['title'] }}</h3>
                    @if(!empty($item['subject']))
                        <p class="{{ $isNewDesign ? 'text-sm text-purple-600 font-bold dark:text-purple-400 mb-4' : 'text-xs text-slate-500 dark:text-slate-400 mb-3' }}">{{ $item['subject'] }}</p>
                    @endif
                    @if(!empty($item['url']))
                        <a
                            href="{{ $item['url'] }}"
                            target="_blank"
                            rel="noopener"
                            class="{{ $isNewDesign ? 'inline-flex items-center gap-2 text-base font-bold text-blue-600 hover:text-blue-800 transition-all hover:scale-105 dark:text-blue-400 dark:hover:text-blue-300' : 'inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors dark:text-blue-400 dark:hover:text-blue-300' }}"
                        >
                            {{ __('site.resources.download') }}
                            <span aria-hidden="true" class="{{ $isNewDesign ? 'text-xl' : '' }}">↓</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="{{
            $isNewDesign
                ? 'text-center py-16 bg-white rounded-[3rem] border-8 border-yellow-300 shadow-2xl relative z-10 dark:bg-slate-900 dark:border-purple-400'
                : 'text-center py-16 bg-white rounded-3xl border border-blue-100 shadow-lg dark:bg-slate-950/70 dark:border-slate-800'
        }}">
            <div class="{{ $isNewDesign ? 'text-8xl mb-6' : 'text-6xl mb-4' }}">📚</div>
            <p class="{{ $isNewDesign ? 'text-2xl font-extrabold text-blue-600 mb-3 dark:text-blue-400' : 'text-lg font-semibold text-slate-700 mb-2 dark:text-slate-200' }}">{{ __('site.resources.coming_soon_title') }}</p>
            <p class="{{ $isNewDesign ? 'text-slate-700 font-medium text-lg dark:text-slate-200 max-w-sm mx-auto' : 'text-slate-500 dark:text-slate-400 max-w-sm mx-auto' }}">{{ __('site.resources.coming_soon_body') }}</p>
            <a
                href="#contact"
                class="{{
                    $isNewDesign
                        ? 'mt-8 inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white'
                        : 'mt-6 inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-105'
                }}"
            >
                @if($isNewDesign)
                    🔔
                @endif
                {{ __('site.resources.notify_me') }}
            </a>
        </div>
    @endif
</section>
