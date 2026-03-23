@php $locale = $locale ?? app()->getLocale(); @endphp
<section id="pricing" class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-purple-100 via-yellow-50 to-blue-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute bottom-10 right-20 w-80 h-80 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="mx-auto max-w-6xl px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 shadow-lg border-4 border-white mb-6 dark:bg-yellow-300">
                ⭐ {{ __('site.pricing.most_popular') }}
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
                {{ $pricing['title'] }}
            </h2>
            <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">{{ $pricing['subtitle'] }}</p>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($pricing['packages'] ?? []) as $index => $package)
                @php
                    $borderColors = ['border-blue-400', 'border-yellow-400', 'border-purple-400'];
                    $bgColors = ['bg-blue-100', 'bg-yellow-100', 'bg-purple-100'];
                @endphp
                <div class="relative group self-start">
                    @if($index === 1)
                        <div class="absolute -inset-2 rounded-[3rem] bg-gradient-to-r from-yellow-400 via-purple-400 to-blue-400 opacity-40 blur-xl animate-pulse"></div>
                    @endif

                    <div class="relative rounded-[2.5rem] border-6 {{ $borderColors[$index] }} bg-white p-8 shadow-2xl overflow-hidden transition-all hover:-translate-y-4 hover:rotate-2 hover:shadow-purple-500/40 dark:bg-slate-900">
                        <div class="flex items-start justify-between gap-4 mb-6">
                            <div>
                                <h3 class="text-2xl font-extrabold text-slate-900 dark:text-slate-100">{{ $package['name'] }}</h3>
                                <p class="mt-2 text-sm font-bold text-purple-600 dark:text-purple-400">{{ __('site.pricing.per_session') }}</p>
                            </div>

                            @if($index === 1)
                                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-yellow-400 to-orange-400 px-4 py-2 text-xs font-black text-blue-900 shadow-lg border-2 border-white">
                                    🏆 {{ __('site.pricing.most_popular') }}
                                </span>
                            @endif
                        </div>

                        <div class="flex items-end gap-2 mb-6">
                            <span class="text-5xl font-black text-blue-600 dark:text-blue-400" style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.2);">${{ $package['price'] ?? '0' }}</span>
                            <span class="pb-2 text-base font-bold text-slate-600 dark:text-slate-300">/ {{ __('site.pricing.per_session') }}</span>
                        </div>

                        <div class="mb-6 h-1 w-full rounded-full {{ $bgColors[$index] }}"></div>

                        <ul class="space-y-4 mb-8">
                            @foreach(($package['details'] ?? []) as $d)
                                <li class="flex items-start gap-3">
                                    <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-xl bg-gradient-to-br from-green-400 to-emerald-500 text-white font-black shadow-lg">✓</span>
                                    <span class="text-base leading-relaxed text-slate-700 font-medium dark:text-slate-200">{{ $d }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a
                            href="{{ route('site.booking', ['locale' => $locale]) }}"
                            class="w-full inline-flex items-center justify-center rounded-full px-8 py-4 text-lg font-bold transition-all shadow-xl {{ $index === 1 ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:shadow-purple-500/50 hover:scale-110 hover:-rotate-1 border-4 border-white' : 'bg-white text-blue-600 border-4 border-blue-500 hover:bg-blue-50 hover:scale-105 dark:bg-slate-900 dark:text-blue-400 dark:border-blue-400' }}"
                        >
                            {{ $index === 1 ? '🎉' : '👉' }} {{ __('site.pricing.choose', ['package' => $package['name']]) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
