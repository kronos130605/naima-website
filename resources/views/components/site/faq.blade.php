<section id="faq" class="mx-auto max-w-4xl px-4 py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
            {{ $faq['title'] }}
        </h2>
        <p class="text-lg text-slate-600">
            {{ __('site.faq.subtitle') }}
        </p>
    </div>
    <div class="space-y-4">
        @foreach(($faq['items'] ?? []) as $index => $item)
            <details class="group bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden hover:shadow-xl transition-all">
                <summary class="cursor-pointer p-6 font-semibold text-lg text-slate-900 hover:bg-blue-50 transition-colors list-none flex items-center justify-between">
                    <span>{{ $item['q'] }}</span>
                    <span class="text-blue-600 transform transition-transform group-open:rotate-180">▼</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-slate-600 leading-relaxed">{{ $item['a'] }}</p>
                </div>
            </details>
        @endforeach
    </div>
</section>
