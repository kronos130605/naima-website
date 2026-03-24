@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="faq" class="{{ $isNewDesign ? 'mx-auto max-w-4xl px-4 py-20 relative' : 'mx-auto max-w-4xl px-4 py-20' }}">
    @if($isNewDesign)
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-20 right-0 w-72 h-72 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'text-center mb-16 relative z-10' : 'text-center mb-12' }}">
        <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);" @endif>
            {{ $faq['title'] }}
        </h2>
        <p class="{{ $isNewDesign ? 'text-xl text-slate-700 font-medium dark:text-slate-200' : 'text-lg text-slate-600' }}">
            {{ __('site.faq.subtitle') }}
        </p>
    </div>

    <div class="{{ $isNewDesign ? 'space-y-6 relative z-10' : 'space-y-4' }}">
        @foreach(($faq['items'] ?? []) as $index => $item)
            <details class="{{
                $isNewDesign
                    ? 'group bg-white rounded-[2rem] shadow-2xl border-6 border-purple-300 overflow-hidden hover:shadow-purple-500/40 transition-all hover:-translate-y-1 dark:bg-slate-900 dark:border-purple-400'
                    : 'group bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden hover:shadow-xl transition-all focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white'
            }}">
                <summary class="{{
                    $isNewDesign
                        ? 'cursor-pointer p-8 font-bold text-xl text-slate-900 hover:bg-purple-50 transition-all list-none flex items-center justify-between outline-none dark:text-slate-100 dark:hover:bg-purple-900/20'
                        : 'cursor-pointer p-6 font-semibold text-lg text-slate-900 hover:bg-blue-50 transition-colors list-none flex items-center justify-between outline-none'
                }}">
                    @if($isNewDesign)
                        <span class="flex items-center gap-3">
                            <span class="text-3xl">❓</span>
                            <span>{{ $item['q'] }}</span>
                        </span>
                        <span class="text-3xl text-purple-600 transform transition-transform group-open:rotate-180 dark:text-purple-400">▼</span>
                    @else
                        <span>{{ $item['q'] }}</span>
                        <span class="text-blue-600 transform transition-transform group-open:rotate-180">▼</span>
                    @endif
                </summary>
                <div class="{{ $isNewDesign ? 'px-8 pb-8 pt-2' : 'px-6 pb-6' }}">
                    <p class="{{ $isNewDesign ? 'text-slate-700 leading-relaxed text-lg font-medium dark:text-slate-200' : 'text-slate-600 leading-relaxed' }}">{{ $item['a'] }}</p>
                </div>
            </details>
        @endforeach
    </div>
</section>
