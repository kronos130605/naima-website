<section class="bg-gradient-to-r from-yellow-400 via-blue-500 to-purple-600 py-12 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-2 left-10 text-6xl">⭐</div>
        <div class="absolute bottom-2 right-20 text-5xl">🎉</div>
        <div class="absolute top-4 right-40 text-4xl">✨</div>
    </div>
    <div class="mx-auto max-w-6xl px-4 relative z-10">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            @foreach(($stats['items'] ?? []) as $item)
                <div class="text-center transform hover:scale-110 transition-all">
                    <div class="text-4xl md:text-5xl font-black text-white mb-2 drop-shadow-lg" style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);">{{ $item['value'] }}</div>
                    <div class="text-base font-bold text-white drop-shadow-md">{{ __('site.stats.' . ($item['lang_key'] ?? '')) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
