@php
    $locale = $locale ?? app()->getLocale();
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="pricing" class="{{ $isNewDesign ? 'relative py-20 overflow-hidden' : 'relative py-20' }}">
    @if($isNewDesign)
        <div class="absolute inset-0 bg-gradient-to-br from-purple-100 via-yellow-50 to-blue-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 right-20 w-80 h-80 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"></div>
        <div class="absolute inset-0 opacity-40 [mask-image:radial-gradient(55%_45%_at_50%_0%,#000_0%,transparent_65%)]">
            <div class="h-full w-full bg-[linear-gradient(to_right,rgba(59,130,246,0.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(59,130,246,0.08)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
        </div>
    @endif

    <div class="mx-auto max-w-6xl px-4 {{ $isNewDesign ? 'relative z-10' : '' }}">
        <div class="{{ $isNewDesign ? 'text-center mb-16' : 'relative text-center mb-12' }}">
            <div class="{{
                $isNewDesign
                    ? 'inline-flex items-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-bold text-blue-900 shadow-lg border-4 border-white mb-6 dark:bg-yellow-300'
                    : 'inline-flex items-center rounded-full border border-blue-200 bg-white/70 px-4 py-2 text-sm font-semibold text-blue-700 shadow-sm dark:border-slate-800 dark:bg-slate-950/60 dark:text-slate-200'
            }}">
                @if($isNewDesign)
                    ⭐
                @endif
                {{ __('site.pricing.most_popular') }}
            </div>
            <h2 class="{{
                $isNewDesign
                    ? 'text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400'
                    : 'mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100'
            }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);" @endif>
                {{ $pricing['title'] }}
            </h2>
            <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'mt-4 text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300' }}">{{ $pricing['subtitle'] }}</p>
        </div>

        <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-3' : 'relative grid gap-6 lg:gap-8 md:grid-cols-3' }}">
            @foreach(($pricing['packages'] ?? []) as $index => $package)
                @php
                    $borderColors = ['border-blue-400', 'border-yellow-400', 'border-purple-400'];
                    $bgColors = ['bg-blue-100', 'bg-yellow-100', 'bg-purple-100'];
                @endphp
                <div class="relative group self-start">
                    @if($index === 1)
                        <div class="{{
                            $isNewDesign
                                ? 'absolute -inset-2 rounded-[3rem] bg-gradient-to-r from-yellow-400 via-purple-400 to-blue-400 opacity-40 blur-xl animate-pulse'
                                : 'absolute -inset-1 rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 opacity-20 blur'
                        }}"></div>
                    @endif

                    <div class="{{
                        $isNewDesign
                            ? 'relative rounded-[2.5rem] border-6 ' . $borderColors[$index] . ' bg-white p-8 shadow-2xl overflow-hidden transition-all hover:-translate-y-4 hover:rotate-2 hover:shadow-purple-500/40 dark:bg-slate-900'
                            : 'relative rounded-3xl border bg-white/90 p-8 shadow-lg backdrop-blur overflow-hidden transition-all hover:-translate-y-0.5 hover:shadow-xl focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950 ' . ($index === 1 ? 'border-blue-500/40' : 'border-blue-100')
                    }}">
                        <div class="{{ $isNewDesign ? 'flex items-start justify-between gap-4 mb-6' : 'flex items-start justify-between gap-4' }}">
                            <div>
                                <h3 class="{{ $isNewDesign ? 'text-2xl font-extrabold' : 'text-xl font-bold' }} text-slate-900 dark:text-slate-100">{{ $package['name'] }}</h3>
                                <p class="{{ $isNewDesign ? 'mt-2 text-sm font-bold text-purple-600 dark:text-purple-400' : 'mt-1 text-sm text-slate-600 dark:text-slate-300' }}">{{ __('site.pricing.per_session') }}</p>
                            </div>

                            @if($index === 1)
                                <span class="{{
                                    $isNewDesign
                                        ? 'inline-flex items-center rounded-full bg-gradient-to-r from-yellow-400 to-orange-400 px-4 py-2 text-xs font-black text-blue-900 shadow-lg border-2 border-white'
                                        : 'inline-flex items-center rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-3 py-1 text-xs font-semibold text-white shadow-sm'
                                }}">
                                    @if($isNewDesign)
                                        🏆
                                    @endif
                                    {{ __('site.pricing.most_popular') }}
                                </span>
                            @endif
                        </div>

                        <div class="{{ $isNewDesign ? 'flex items-end gap-2 mb-6' : 'mt-6 flex items-end gap-2' }}">
                            <span class="{{ $isNewDesign ? 'text-5xl font-black text-blue-600 dark:text-blue-400' : 'text-4xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(147, 51, 234, 0.2);" @endif>${{ $package['price'] ?? '0' }}</span>
                            <span class="{{ $isNewDesign ? 'pb-2 text-base font-bold text-slate-600 dark:text-slate-300' : 'pb-1 text-sm text-slate-500 dark:text-slate-400' }}">/ {{ __('site.pricing.per_session') }}</span>
                        </div>

                        <div class="{{ $isNewDesign ? 'mb-6 h-1 w-full rounded-full ' . $bgColors[$index] : 'mt-6 h-px w-full bg-gradient-to-r from-blue-100 via-blue-50 to-transparent dark:from-slate-800 dark:via-slate-900' }}"></div>

                        <ul class="{{ $isNewDesign ? 'space-y-4 mb-8' : 'mt-6 space-y-3' }}">
                            @foreach(($package['details'] ?? []) as $d)
                                <li class="flex items-start gap-3">
                                    <span class="{{
                                        $isNewDesign
                                            ? 'mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-xl bg-gradient-to-br from-green-400 to-emerald-500 text-white font-black shadow-lg'
                                            : 'mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-700 dark:bg-slate-900 dark:text-slate-200'
                                    }}">✓</span>
                                    <span class="{{ $isNewDesign ? 'text-base leading-relaxed text-slate-700 font-medium dark:text-slate-200' : 'text-sm leading-relaxed text-slate-600 dark:text-slate-300' }}">{{ $d }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a
                            href="{{ route('site.booking', ['locale' => $locale]) }}"
                            class="{{
                                $isNewDesign
                                    ? ('w-full inline-flex items-center justify-center rounded-full px-8 py-4 text-lg font-bold transition-all shadow-xl ' . ($index === 1 ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:shadow-purple-500/50 hover:scale-110 hover:-rotate-1 border-4 border-white' : 'bg-white text-blue-600 border-4 border-blue-500 hover:bg-blue-50 hover:scale-105 dark:bg-slate-900 dark:text-blue-400 dark:border-blue-400'))
                                    : ('mt-8 w-full inline-flex items-center justify-center rounded-xl px-6 py-3 text-sm font-semibold transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950 ' . ($index === 1 ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg hover:shadow-xl hover:scale-[1.02]' : 'bg-white text-slate-900 border border-blue-200 hover:bg-blue-50 hover:border-blue-300 dark:bg-slate-950 dark:text-slate-100 dark:border-slate-800 dark:hover:bg-slate-900'))
                            }}"
                        >
                            @if($isNewDesign)
                                {{ $index === 1 ? '🎉' : '👉' }}
                            @endif
                            {{ __('site.pricing.choose', ['package' => $package['name']]) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
