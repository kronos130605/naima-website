<section id="strategy" class="bg-white/50 backdrop-blur-sm py-20 dark:bg-slate-950/30">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                {{ $strategy['title'] }}
            </h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300">
                {{ __('site.strategy.subtitle') }}
            </p>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($strategy['items'] ?? []) as $index => $item)
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r {{ $index === 0 ? 'from-blue-400 to-cyan-400' : ($index === 1 ? 'from-indigo-400 to-purple-400' : 'from-purple-400 to-pink-400') }} rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity dark:group-hover:opacity-20"></div>
                    <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 hover:shadow-xl transition-shadow dark:bg-slate-950/70 dark:border-slate-800">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-r {{ $index === 0 ? 'from-blue-500 to-cyan-500' : ($index === 1 ? 'from-indigo-500 to-purple-500' : 'from-purple-500 to-pink-500') }} flex items-center justify-center text-white text-2xl mb-6">
                            {{ $index === 0 ? '🎯' : ($index === 1 ? '📚' : '🚀') }}
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4 dark:text-slate-100">{{ $item['title'] }}</h3>
                        <p class="text-slate-600 leading-relaxed dark:text-slate-300">{{ $item['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
