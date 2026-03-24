@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section class="{{ $isNewDesign ? 'bg-gradient-to-r from-yellow-400 via-blue-500 to-purple-600 py-12 relative overflow-hidden' : 'bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-10' }}">
    @if($isNewDesign)
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-2 left-10 text-6xl">⭐</div>
            <div class="absolute bottom-2 right-20 text-5xl">🎉</div>
            <div class="absolute top-4 right-40 text-4xl">✨</div>
        </div>
    @endif
    <div class="mx-auto max-w-6xl px-4 {{ $isNewDesign ? 'relative z-10' : '' }}">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            @foreach(($stats['items'] ?? []) as $item)
                <div class="{{ $isNewDesign ? 'text-center transform hover:scale-110 transition-all' : 'text-center' }}">
                    <div class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-black text-white mb-2 drop-shadow-lg' : 'text-3xl md:text-4xl font-extrabold text-white mb-1' }}" @if($isNewDesign) style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);" @endif>{{ $item['value'] }}</div>
                    <div class="{{ $isNewDesign ? 'text-base font-bold text-white drop-shadow-md' : 'text-sm font-medium text-blue-100' }}">{{ __('site.stats.' . ($item['lang_key'] ?? '')) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
