<section id="testimonials" class="bg-gradient-to-br from-yellow-100 via-purple-50 to-blue-100 py-20 relative overflow-hidden dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    <div class="absolute top-20 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute bottom-10 right-20 w-80 h-80 bg-purple-300 rounded-full opacity-10 blur-3xl"></div>
    
    <div class="mx-auto max-w-6xl px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
                {{ $testimonials['title'] }}
            </h2>
            <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">
                {{ __('site.testimonials.subtitle') }}
            </p>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($testimonials['items'] ?? []) as $t)
                <div class="relative bg-white rounded-[2rem] shadow-2xl border-6 border-yellow-300 p-8 hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400">
                    <div class="flex text-yellow-400 text-2xl mb-4">
                        @for($i = 0; $i < (int)($t['rating'] ?? 5); $i++)
                            ★
                        @endfor
                    </div>
                    <blockquote class="text-slate-700 leading-relaxed font-medium text-base dark:text-slate-100 mb-6">
                        "{{ $t['body'] }}"
                    </blockquote>
                    <div class="flex items-center gap-4 border-t-4 border-yellow-200 pt-4 dark:border-purple-600">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-lg font-black shadow-lg">
                            {{ strtoupper(mb_substr($t['name'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-blue-600 text-base dark:text-blue-400">{{ $t['name'] }}</p>
                            @if(!empty($t['role']))
                                <p class="text-sm text-purple-600 font-medium dark:text-purple-400">{{ $t['role'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
