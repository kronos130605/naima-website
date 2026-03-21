<section id="testimonials" class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                {{ $testimonials['title'] }}
            </h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300">
                {{ __('site.testimonials.subtitle') }}
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($testimonials['items'] ?? []) as $t)
                <div class="relative bg-white rounded-2xl shadow-lg border border-blue-100 p-8 hover:shadow-xl transition-all hover:-translate-y-0.5 dark:bg-slate-950/70 dark:border-slate-800">
                    <div class="flex text-yellow-400 text-lg mb-4">
                        @for($i = 0; $i < (int)($t['rating'] ?? 5); $i++)
                            ★
                        @endfor
                    </div>
                    <blockquote class="text-slate-700 leading-relaxed italic dark:text-slate-200 mb-6">
                        "{{ $t['body'] }}"
                    </blockquote>
                    <div class="flex items-center gap-3 border-t border-blue-50 pt-4 dark:border-slate-800">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-indigo-400 flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(mb_substr($t['name'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm dark:text-slate-100">{{ $t['name'] }}</p>
                            @if(!empty($t['role']))
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $t['role'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
