@php
    $locale = $locale ?? app()->getLocale();
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section class="{{ $isNewDesign ? 'mx-auto max-w-6xl px-4 py-24 relative overflow-hidden' : 'mx-auto max-w-6xl px-4 py-24' }}">
    @if($isNewDesign)
        <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-40 h-40 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'grid gap-12 md:grid-cols-2 md:items-center relative z-10' : 'grid gap-12 md:grid-cols-2 md:items-center' }}">
        <div class="space-y-6">
            <div class="{{ $isNewDesign ? 'inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 shadow-lg border-4 border-white dark:bg-yellow-300 dark:text-blue-900' : 'inline-flex items-center rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 px-4 py-2 text-sm font-semibold text-blue-800 dark:from-slate-800 dark:to-slate-700 dark:text-slate-100' }}">
                @if($isNewDesign)
                    ✨
                @endif
                {{ __('site.hero.badge') }}
            </div>
            <h1 class="{{ $isNewDesign ? 'text-5xl md:text-6xl font-extrabold leading-tight text-blue-600 dark:text-blue-400' : 'text-5xl md:text-6xl font-bold leading-tight bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent' }}" @if($isNewDesign) style="text-shadow: 3px 3px 0px rgba(147, 51, 234, 0.3);" @endif>
                {!! __('site.hero.title_html') !!}
            </h1>
            <p class="{{ $isNewDesign ? 'text-xl text-slate-700 leading-relaxed font-medium dark:text-slate-200' : 'text-lg text-slate-600 leading-relaxed dark:text-slate-300' }}">
                {{ __('site.hero.subtitle') }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a
                    href="{{ route('site.booking', ['locale' => $locale]) }}"
                    class="{{ $isNewDesign ? 'inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white' : 'inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-105' }}"
                >
                    @if($isNewDesign)
                        🎯
                    @endif
                    {{ __('site.cta.book_free_assessment') }}
                </a>
                <a
                    href="#pricing"
                    class="{{ $isNewDesign ? 'inline-flex items-center justify-center rounded-full border-4 border-blue-500 bg-white px-8 py-4 text-lg font-bold text-blue-600 hover:bg-blue-50 transition-all hover:scale-105 shadow-lg dark:bg-slate-900 dark:text-blue-400 dark:border-blue-400' : 'inline-flex items-center justify-center rounded-xl border-2 border-blue-200 bg-white/80 backdrop-blur px-6 py-3 text-base font-semibold text-blue-600 hover:border-blue-400 hover:bg-blue-50 transition-all dark:border-slate-700 dark:bg-slate-950/40 dark:text-slate-100 dark:hover:bg-slate-800' }}"
                >
                    @if($isNewDesign)
                        💰
                    @endif
                    {{ __('site.cta.see_pricing') }}
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="{{ $isNewDesign ? 'absolute -inset-4 bg-gradient-to-r from-yellow-400 via-purple-400 to-blue-400 rounded-[3rem] transform rotate-6 opacity-30 blur-xl' : 'absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl transform rotate-3 opacity-20' }}"></div>
            <div class="{{ $isNewDesign ? 'relative bg-white rounded-[2.5rem] shadow-2xl p-8 border-8 border-yellow-300 overflow-hidden hover:shadow-purple-500/30 transition-all hover:-translate-y-2 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400' : 'relative bg-white rounded-3xl shadow-2xl p-8 border border-blue-100 overflow-hidden hover:shadow-[0_30px_80px_-40px_rgba(15,23,42,0.35)] transition-all hover:-translate-y-0.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950' }}">
                <div class="{{ $isNewDesign ? 'flex items-center gap-3 mb-6' : 'flex items-center gap-2 mb-6' }}">
                    <div class="{{ $isNewDesign ? 'flex -space-x-3' : 'flex -space-x-2' }}">
                        @for($i = 0; $i < 3; $i++)
                            <div class="{{ $isNewDesign ? 'w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 border-4 border-white shadow-lg' : 'w-8 h-8 rounded-full bg-gradient-to-r from-blue-400 to-indigo-400 border-2 border-white' }}"></div>
                        @endfor
                    </div>
                    <div class="{{ $isNewDesign ? 'flex text-yellow-400 text-2xl' : 'flex text-yellow-400' }}">
                        ★★★★★
                    </div>
                </div>
                @foreach(($testimonials['items'] ?? []) as $t)
                    <blockquote class="{{ $isNewDesign ? 'space-y-4' : 'space-y-3' }}">
                        <p class="{{ $isNewDesign ? 'text-slate-700 text-lg font-medium dark:text-slate-100' : 'text-slate-700 italic dark:text-slate-200' }}">"{{ $t['body'] }}"</p>
                        <div class="flex items-center justify-between">
                            <cite class="{{ $isNewDesign ? 'font-bold text-blue-600 not-italic text-lg dark:text-blue-400' : 'font-semibold text-slate-900 not-italic dark:text-slate-100' }}">{{ $t['name'] }}</cite>
                            <span class="{{ $isNewDesign ? 'text-xl text-yellow-400' : 'text-sm text-slate-500 dark:text-slate-400' }}">{{ str_repeat('★', (int) ($t['rating'] ?? 0)) }}</span>
                        </div>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </div>
</section>
