@php $locale = $locale ?? app()->getLocale(); @endphp
<section class="mx-auto max-w-6xl px-4 py-24 relative overflow-hidden">
    <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-40 h-40 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="grid gap-12 md:grid-cols-2 md:items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 shadow-lg border-4 border-white dark:bg-yellow-300 dark:text-blue-900">
                ✨ {{ __('site.hero.badge') }}
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight text-blue-600 dark:text-blue-400" style="text-shadow: 3px 3px 0px rgba(147, 51, 234, 0.3);">
                {!! __('site.hero.title_html') !!}
            </h1>
            <p class="text-xl text-slate-700 leading-relaxed font-medium dark:text-slate-200">
                {{ __('site.hero.subtitle') }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a
                    href="{{ route('site.booking', ['locale' => $locale]) }}"
                    class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-4 text-lg font-bold text-white shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white"
                >
                    🎯 {{ __('site.cta.book_free_assessment') }}
                </a>
                <a
                    href="#pricing"
                    class="inline-flex items-center justify-center rounded-full border-4 border-blue-500 bg-white px-8 py-4 text-lg font-bold text-blue-600 hover:bg-blue-50 transition-all hover:scale-105 shadow-lg dark:bg-slate-900 dark:text-blue-400 dark:border-blue-400"
                >
                    💰 {{ __('site.cta.see_pricing') }}
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-yellow-400 via-purple-400 to-blue-400 rounded-[3rem] transform rotate-6 opacity-30 blur-xl"></div>
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl p-8 border-8 border-yellow-300 overflow-hidden hover:shadow-purple-500/30 transition-all hover:-translate-y-2 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex -space-x-3">
                        @for($i = 0; $i < 3; $i++)
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 border-4 border-white shadow-lg"></div>
                        @endfor
                    </div>
                    <div class="flex text-yellow-400 text-2xl">
                        ★★★★★
                    </div>
                </div>
                @foreach(($testimonials['items'] ?? []) as $t)
                    <blockquote class="space-y-4">
                        <p class="text-slate-700 text-lg font-medium dark:text-slate-100">"{{ $t['body'] }}"</p>
                        <div class="flex items-center justify-between">
                            <cite class="font-bold text-blue-600 not-italic text-lg dark:text-blue-400">{{ $t['name'] }}</cite>
                            <span class="text-xl text-yellow-400">{{ str_repeat('★', (int) ($t['rating'] ?? 0)) }}</span>
                        </div>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </div>
</section>
