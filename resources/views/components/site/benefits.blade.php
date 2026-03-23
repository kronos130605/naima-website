<section class="mx-auto max-w-6xl px-4 py-20 relative">
    <div class="absolute bottom-10 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="text-center mb-16 relative z-10">
        <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
            {{ $benefits['title'] }}
        </h2>
        <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">
            {{ __('site.benefits.subtitle') }}
        </p>
    </div>
    <div class="grid gap-8 md:grid-cols-3 relative z-10">
        @foreach(($benefits['items'] ?? []) as $index => $item)
            @php
                $bgColors = ['bg-green-100 border-green-400', 'bg-blue-100 border-blue-400', 'bg-purple-100 border-purple-400'];
                $gradients = ['from-green-500 to-emerald-500', 'from-blue-500 to-indigo-500', 'from-purple-500 to-pink-500'];
                $icons = ['⚡', '🎯', '💎'];
            @endphp
            <div class="relative group self-start">
                <div class="relative bg-white rounded-[2rem] shadow-2xl p-8 border-6 {{ $bgColors[$index] }} overflow-hidden hover:shadow-green-500/30 transition-all hover:-translate-y-3 hover:-rotate-2 dark:bg-slate-900 dark:border-purple-400">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br {{ $gradients[$index] }} flex items-center justify-center text-white text-4xl mb-6 shadow-xl border-4 border-white transform group-hover:scale-110 group-hover:rotate-12 transition-all">
                        {{ $icons[$index] }}
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4 dark:text-slate-100">{{ $item['title'] }}</h3>
                    <p class="text-slate-700 leading-relaxed font-medium dark:text-slate-200">{{ $item['body'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
