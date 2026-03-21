<section id="pricing" class="bg-gradient-to-br from-blue-50 to-indigo-50 py-20">
    <div class="mx-auto max-w-6xl px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                {{ $pricing['title'] }}
            </h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">{{ $pricing['subtitle'] }}</p>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($pricing['packages'] ?? []) as $index => $package)
                <div class="relative group">
                    @if($index === 1)
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-20"></div>
                    @endif
                    <div class="relative bg-white rounded-2xl shadow-lg p-8 border {{ $index === 1 ? 'border-blue-500' : 'border-blue-100' }} hover:shadow-xl transition-all">
                        @if($index === 1)
                            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold">
                                    {{ __('site.pricing.most_popular') }}
                                </span>
                            </div>
                        @endif
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $package['name'] }}</h3>
                        <div class="mb-6">
                            <span class="text-3xl font-bold text-blue-600">${{ $package['price'] ?? '0' }}</span>
                            <span class="text-slate-600">{{ __('site.pricing.per_session') }}</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            @foreach(($package['details'] ?? []) as $d)
                                <li class="flex items-start gap-2">
                                    <span class="text-green-500 mt-1">✓</span>
                                    <span class="text-slate-600">{{ $d }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a
                            href="{{ $cta['booking_url'] ?? '#' }}"
                            class="w-full inline-flex items-center justify-center rounded-xl {{ $index === 1 ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-blue-100 text-blue-600 hover:bg-blue-200' }} px-6 py-3 font-semibold transition-all hover:scale-105"
                        >
                            {{ __('site.pricing.choose', ['package' => $package['name']]) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
