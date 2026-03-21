<section id="pricing" class="relative py-20">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
    <div class="absolute inset-0 opacity-40 [mask-image:radial-gradient(55%_45%_at_50%_0%,#000_0%,transparent_65%)]">
        <div class="h-full w-full bg-[linear-gradient(to_right,rgba(59,130,246,0.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(59,130,246,0.08)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
    </div>
    <div class="mx-auto max-w-6xl px-4">
        <div class="relative text-center mb-12">
            <div class="inline-flex items-center rounded-full border border-blue-200 bg-white/70 px-4 py-2 text-sm font-semibold text-blue-700 shadow-sm dark:border-slate-800 dark:bg-slate-950/60 dark:text-slate-200">
                {{ __('site.pricing.most_popular') }}
            </div>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                {{ $pricing['title'] }}
            </h2>
            <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300">{{ $pricing['subtitle'] }}</p>
        </div>
        <div class="relative grid gap-6 lg:gap-8 md:grid-cols-3">
            @foreach(($pricing['packages'] ?? []) as $index => $package)
                <div class="relative group self-start">
                    @if($index === 1)
                        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 opacity-20 blur"></div>
                    @endif

                    <div class="relative rounded-3xl border bg-white/90 p-8 shadow-lg backdrop-blur overflow-hidden transition-all hover:-translate-y-0.5 hover:shadow-xl focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950 {{ $index === 1 ? 'border-blue-500/40' : 'border-blue-100' }}">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ $package['name'] }}</h3>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ __('site.pricing.per_session') }}</p>
                            </div>

                            @if($index === 1)
                                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                                    {{ __('site.pricing.most_popular') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-6 flex items-end gap-2">
                            <span class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">${{ $package['price'] ?? '0' }}</span>
                            <span class="pb-1 text-sm text-slate-500 dark:text-slate-400">/ {{ __('site.pricing.per_session') }}</span>
                        </div>

                        <div class="mt-6 h-px w-full bg-gradient-to-r from-blue-100 via-blue-50 to-transparent dark:from-slate-800 dark:via-slate-900"></div>

                        <ul class="mt-6 space-y-3">
                            @foreach(($package['details'] ?? []) as $d)
                                <li class="flex items-start gap-3">
                                    <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-700 dark:bg-slate-900 dark:text-slate-200">✓</span>
                                    <span class="text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ $d }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a
                            href="{{ $cta['booking_url'] ?? '#' }}"
                            class="mt-8 w-full inline-flex items-center justify-center rounded-xl px-6 py-3 text-sm font-semibold transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950 {{ $index === 1 ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg hover:shadow-xl hover:scale-[1.02]' : 'bg-white text-slate-900 border border-blue-200 hover:bg-blue-50 hover:border-blue-300 dark:bg-slate-950 dark:text-slate-100 dark:border-slate-800 dark:hover:bg-slate-900' }}"
                        >
                            {{ __('site.pricing.choose', ['package' => $package['name']]) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
