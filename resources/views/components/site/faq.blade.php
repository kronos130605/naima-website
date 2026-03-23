<section id="faq" class="mx-auto max-w-4xl px-4 py-20 relative">
    <div class="absolute top-0 left-0 w-64 h-64 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute bottom-20 right-0 w-72 h-72 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="text-center mb-16 relative z-10">
        <h2 class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 dark:text-blue-400" style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.3);">
            {{ $faq['title'] }}
        </h2>
        <p class="text-xl text-slate-700 font-medium dark:text-slate-200">
            {{ __('site.faq.subtitle') }}
        </p>
    </div>
    <div class="space-y-6 relative z-10">
        @foreach(($faq['items'] ?? []) as $index => $item)
            <details class="group bg-white rounded-[2rem] shadow-2xl border-6 border-purple-300 overflow-hidden hover:shadow-purple-500/40 transition-all hover:-translate-y-1 dark:bg-slate-900 dark:border-purple-400">
                <summary class="cursor-pointer p-8 font-bold text-xl text-slate-900 hover:bg-purple-50 transition-all list-none flex items-center justify-between outline-none dark:text-slate-100 dark:hover:bg-purple-900/20">
                    <span class="flex items-center gap-3">
                        <span class="text-3xl">❓</span>
                        <span>{{ $item['q'] }}</span>
                    </span>
                    <span class="text-3xl text-purple-600 transform transition-transform group-open:rotate-180 dark:text-purple-400">▼</span>
                </summary>
                <div class="px-8 pb-8 pt-2">
                    <p class="text-slate-700 leading-relaxed text-lg font-medium dark:text-slate-200">{{ $item['a'] }}</p>
                </div>
            </details>
        @endforeach
    </div>
</section>
