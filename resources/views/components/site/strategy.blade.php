@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="strategy" class="{{ $isNewDesign ? 'bg-gradient-to-br from-purple-100 via-blue-50 to-yellow-100 py-20 relative overflow-hidden dark:bg-slate-950/30' : 'bg-white/50 backdrop-blur-sm py-20 dark:bg-slate-950/30' }}">
    @if($isNewDesign)
        <div class="absolute top-10 right-1/4 w-56 h-56 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="mx-auto max-w-6xl px-4 {{ $isNewDesign ? 'relative z-10' : '' }}">
        <div class="{{ $isNewDesign ? 'text-center mb-16' : 'text-center mb-12' }}">
            <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);" @endif>
                {{ $strategy['title'] }}
            </h2>
            <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300' }}">
                {{ __('site.strategy.subtitle') }}
            </p>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($strategy['items'] ?? []) as $index => $item)
                @php
                    $bgColors = ['bg-blue-100 border-blue-400', 'bg-purple-100 border-purple-400', 'bg-yellow-100 border-yellow-400'];
                    $gradients = ['from-blue-500 to-cyan-500', 'from-indigo-500 to-purple-500', 'from-purple-500 to-pink-500'];
                    $icons = ['🎯', '📚', '🚀'];
                @endphp
                <div class="relative group self-start">
                    @if(!$isNewDesign)
                        <div class="absolute inset-0 bg-gradient-to-r {{ $gradients[$index] }} rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity dark:group-hover:opacity-20"></div>
                    @endif

                    <div class="{{
                        $isNewDesign
                            ? ('relative bg-white rounded-[2rem] shadow-2xl p-8 border-6 ' . $bgColors[$index] . ' overflow-hidden hover:shadow-purple-500/30 transition-all hover:-translate-y-3 hover:rotate-2 dark:bg-slate-900 dark:border-purple-400')
                            : 'relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 overflow-hidden hover:shadow-xl transition-all hover:-translate-y-0.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950'
                    }}">
                        <div class="{{ $isNewDesign ? 'w-20 h-20 rounded-3xl bg-gradient-to-br' : 'w-16 h-16 rounded-full bg-gradient-to-r' }} {{ $gradients[$index] }} flex items-center justify-center text-white {{ $isNewDesign ? 'text-4xl' : 'text-2xl' }} mb-6 {{ $isNewDesign ? 'shadow-xl border-4 border-white transform group-hover:scale-110 group-hover:-rotate-12 transition-all' : '' }}">
                            {{ $icons[$index] }}
                        </div>
                        <h3 class="{{ $isNewDesign ? 'text-2xl font-extrabold' : 'text-xl font-bold' }} text-slate-900 mb-4 dark:text-slate-100">{{ $item['title'] }}</h3>
                        <p class="{{ $isNewDesign ? 'text-slate-700 leading-relaxed font-medium dark:text-slate-200' : 'text-slate-600 leading-relaxed dark:text-slate-300' }}">{{ $item['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
