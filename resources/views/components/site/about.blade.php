<section id="about" class="mx-auto max-w-6xl px-4 py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
            {{ $about['title'] }}
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
            {{ __('site.about.subtitle') }}
        </p>
    </div>
    <div class="grid gap-8 md:grid-cols-3 items-center">
        <div class="md:col-span-1">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl transform rotate-6 opacity-20"></div>
                <div class="relative aspect-square w-full max-w-[280px] mx-auto rounded-3xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center border-2 border-blue-200">
                    <div class="text-6xl">👩‍🏫</div>
                </div>
            </div>
        </div>
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-blue-100 overflow-hidden hover:shadow-xl transition-all focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white">
                <p class="text-lg leading-relaxed text-slate-700 whitespace-pre-line">{{ $about['body'] }}</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">🎓</div>
                    <div>
                        <p class="font-semibold">{{ __('site.about.highlight_1_title') }}</p>
                        <p class="text-sm text-slate-600">{{ __('site.about.highlight_1_body') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">💝</div>
                    <div>
                        <p class="font-semibold">{{ __('site.about.highlight_2_title') }}</p>
                        <p class="text-sm text-slate-600">{{ __('site.about.highlight_2_body') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
