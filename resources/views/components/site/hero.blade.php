@php $locale = $locale ?? app()->getLocale(); @endphp
<section class="mx-auto max-w-6xl px-4 py-24">
    <div class="grid gap-12 md:grid-cols-2 md:items-center">
        <div class="space-y-6">
            <div class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 px-4 py-2 text-sm font-semibold text-blue-800 dark:from-slate-800 dark:to-slate-700 dark:text-slate-100">
                {{ __('site.hero.badge') }}
            </div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                {!! __('site.hero.title_html') !!}
            </h1>
            <p class="text-lg text-slate-600 leading-relaxed dark:text-slate-300">
                {{ __('site.hero.subtitle') }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a
                    href="{{ route('site.booking', ['locale' => $locale]) }}"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-105"
                >
                    {{ __('site.cta.book_free_assessment') }}
                </a>
                <a
                    href="#pricing"
                    class="inline-flex items-center justify-center rounded-xl border-2 border-blue-200 bg-white/80 backdrop-blur px-6 py-3 text-base font-semibold text-blue-600 hover:border-blue-400 hover:bg-blue-50 transition-all dark:border-slate-700 dark:bg-slate-950/40 dark:text-slate-100 dark:hover:bg-slate-800"
                >
                    {{ __('site.cta.see_pricing') }}
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl transform rotate-3 opacity-20"></div>
            <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-blue-100 overflow-hidden hover:shadow-[0_30px_80px_-40px_rgba(15,23,42,0.35)] transition-all hover:-translate-y-0.5 focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950">
                <div class="flex items-center gap-2 mb-6">
                    <div class="flex -space-x-2">
                        @for($i = 0; $i < 3; $i++)
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-400 to-indigo-400 border-2 border-white"></div>
                        @endfor
                    </div>
                    <div class="flex text-yellow-400">
                        ★★★★★
                    </div>
                </div>
                @foreach(($testimonials['items'] ?? []) as $t)
                    <blockquote class="space-y-3">
                        <p class="text-slate-700 italic dark:text-slate-200">"{{ $t['body'] }}"</p>
                        <div class="flex items-center justify-between">
                            <cite class="font-semibold text-slate-900 not-italic dark:text-slate-100">{{ $t['name'] }}</cite>
                            <span class="text-sm text-slate-500 dark:text-slate-400">{{ str_repeat('★', (int) ($t['rating'] ?? 0)) }}</span>
                        </div>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </div>
</section>
