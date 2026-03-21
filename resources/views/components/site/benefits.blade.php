<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
            {{ $benefits['title'] }}
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
            {{ __('site.benefits.subtitle') }}
        </p>
    </div>
    <div class="grid gap-8 md:grid-cols-3">
        @foreach(($benefits['items'] ?? []) as $index => $item)
            <div class="relative group self-start">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 overflow-hidden hover:shadow-xl transition-all hover:-translate-y-0.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-r {{ $index === 0 ? 'from-green-500 to-emerald-500' : ($index === 1 ? 'from-blue-500 to-indigo-500' : 'from-purple-500 to-pink-500') }} flex items-center justify-center text-white text-xl mb-6">
                        {{ $index === 0 ? '⚡' : ($index === 1 ? '🎯' : '💎') }}
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $item['title'] }}</h3>
                    <p class="text-slate-600 leading-relaxed">{{ $item['body'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
