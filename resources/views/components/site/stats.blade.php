<section class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 py-10">
    <div class="mx-auto max-w-6xl px-4">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            @foreach(($stats['items'] ?? []) as $item)
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-extrabold text-white mb-1">{{ $item['value'] }}</div>
                    <div class="text-sm font-medium text-blue-100">{{ __('site.stats.' . ($item['lang_key'] ?? '')) }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
