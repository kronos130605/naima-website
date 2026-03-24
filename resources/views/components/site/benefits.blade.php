@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section class="{{ $isNewDesign ? 'mx-auto max-w-6xl px-4 py-20 relative' : 'mx-auto max-w-6xl px-4 py-20' }}">
    @if($isNewDesign)
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="{{ $isNewDesign ? 'text-center mb-16 relative z-10' : 'text-center mb-12' }}">
        <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);" @endif>
            {{ $benefits['title'] }}
        </h2>
        <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto' }}">
            {{ __('site.benefits.subtitle') }}
        </p>
    </div>

    <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-3 relative z-10' : 'grid gap-8 md:grid-cols-3' }}">
        @foreach(($benefits['items'] ?? []) as $index => $item)
            @php
                $bgColors = ['bg-green-100 border-green-400', 'bg-blue-100 border-blue-400', 'bg-purple-100 border-purple-400'];
                $gradients = ['from-green-500 to-emerald-500', 'from-blue-500 to-indigo-500', 'from-purple-500 to-pink-500'];
                $icons = ['⚡', '🎯', '💎'];
            @endphp
            <div class="relative group self-start">
                <div class="{{
                    $isNewDesign
                        ? ('relative bg-white rounded-[2rem] shadow-2xl p-8 border-6 ' . $bgColors[$index] . ' overflow-hidden hover:shadow-green-500/30 transition-all hover:-translate-y-3 hover:-rotate-2 dark:bg-slate-900 dark:border-purple-400')
                        : 'relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 overflow-hidden hover:shadow-xl transition-all hover:-translate-y-0.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white'
                }}">
                    @if($isNewDesign)
                        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br {{ $gradients[$index] }} flex items-center justify-center text-white text-4xl mb-6 shadow-xl border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all">
                            {{ $icons[$index] }}
                        </div>
                    @else
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-r {{ $gradients[$index] }} flex items-center justify-center text-white text-xl mb-6">
                            {{ $icons[$index] }}
                        </div>
                    @endif
                    <h3 class="{{ $isNewDesign ? 'text-2xl font-extrabold' : 'text-xl font-bold' }} text-slate-900 mb-4 {{ $isNewDesign ? 'dark:text-slate-100' : '' }}">{{ $item['title'] }}</h3>
                    <p class="{{ $isNewDesign ? 'text-slate-700 leading-relaxed font-medium dark:text-slate-200' : 'text-slate-600 leading-relaxed' }}">{{ $item['body'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
