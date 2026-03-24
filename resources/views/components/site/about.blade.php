@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="about" class="{{ $isNewDesign ? 'mx-auto max-w-6xl px-4 py-20 relative' : 'mx-auto max-w-6xl px-4 py-20' }}">
    @if($isNewDesign)
        <div class="absolute top-10 right-10 w-48 h-48 bg-purple-200 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'text-center mb-16 relative z-10' : 'text-center mb-12' }}">
        <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);" @endif>
            {{ $about['title'] }}
        </h2>
        <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto' }}">
            {{ __('site.about.subtitle') }}
        </p>
    </div>
    <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-3 items-center relative z-10' : 'grid gap-8 md:grid-cols-3 items-center' }}">
        <div class="md:col-span-1">
            <div class="relative">
                <div class="{{ $isNewDesign ? 'absolute -inset-3 bg-gradient-to-r from-yellow-400 to-purple-500 rounded-[3rem] transform rotate-6 opacity-30 blur-lg' : 'absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl transform rotate-6 opacity-20' }}"></div>
                <div class="{{ $isNewDesign ? 'relative aspect-square w-full max-w-[280px] mx-auto rounded-[3rem] bg-gradient-to-br from-yellow-200 to-purple-200 flex items-center justify-center border-8 border-white shadow-2xl transform hover:scale-105 hover:rotate-3 transition-all' : 'relative aspect-square w-full max-w-[280px] mx-auto rounded-3xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center border-2 border-blue-200' }}">
                    <div class="{{ $isNewDesign ? 'text-8xl' : 'text-6xl' }}">👩‍🏫</div>
                </div>
            </div>
        </div>
        <div class="md:col-span-2 space-y-6">
            <div class="{{ $isNewDesign ? 'bg-white rounded-[2rem] shadow-2xl p-8 border-6 border-blue-300 overflow-hidden hover:shadow-purple-500/30 transition-all hover:-translate-y-1 dark:bg-slate-900 dark:border-purple-400' : 'bg-white rounded-2xl shadow-lg p-8 border border-blue-100 overflow-hidden hover:shadow-xl transition-all focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white' }}">
                <p class="{{ $isNewDesign ? 'text-lg leading-relaxed text-slate-700 whitespace-pre-line font-medium dark:text-slate-100' : 'text-lg leading-relaxed text-slate-700 whitespace-pre-line' }}">{{ $about['body'] }}</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="{{ $isNewDesign ? 'flex items-center gap-4 bg-blue-100 rounded-2xl p-4 border-4 border-blue-300 shadow-lg hover:scale-105 transition-all dark:bg-blue-900/30 dark:border-blue-500' : 'flex items-center gap-3' }}">
                    <div class="{{ $isNewDesign ? 'w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-3xl shadow-lg' : 'w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600' }}">🎓</div>
                    <div>
                        <p class="{{ $isNewDesign ? 'font-bold text-blue-900 dark:text-blue-200' : 'font-semibold' }}">{{ __('site.about.highlight_1_title') }}</p>
                        <p class="{{ $isNewDesign ? 'text-sm text-blue-700 font-medium dark:text-blue-300' : 'text-sm text-slate-600' }}">{{ __('site.about.highlight_1_body') }}</p>
                    </div>
                </div>
                <div class="{{ $isNewDesign ? 'flex items-center gap-4 bg-purple-100 rounded-2xl p-4 border-4 border-purple-300 shadow-lg hover:scale-105 transition-all dark:bg-purple-900/30 dark:border-purple-500' : 'flex items-center gap-3' }}">
                    <div class="{{ $isNewDesign ? 'w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-3xl shadow-lg' : 'w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600' }}">💝</div>
                    <div>
                        <p class="{{ $isNewDesign ? 'font-bold text-purple-900 dark:text-purple-200' : 'font-semibold' }}">{{ __('site.about.highlight_2_title') }}</p>
                        <p class="{{ $isNewDesign ? 'text-sm text-purple-700 font-medium dark:text-purple-300' : 'text-sm text-slate-600' }}">{{ __('site.about.highlight_2_body') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
