<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $brand['name'] ?? 'FrenchBoost' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 text-slate-900 min-h-screen">
    <header class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50">
        <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between gap-4">
            <a href="/{{ $locale }}" class="font-bold text-xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                {{ $brand['name'] ?? 'FrenchBoost' }}
            </a>

            <div class="flex items-center gap-3">
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a class="hover:text-blue-600 transition-colors" href="#about">About</a>
                    <a class="hover:text-blue-600 transition-colors" href="#strategy">Strategy</a>
                    <a class="hover:text-blue-600 transition-colors" href="#pricing">Pricing</a>
                    <a class="hover:text-blue-600 transition-colors" href="#faq">FAQ</a>
                    <a class="hover:text-blue-600 transition-colors" href="#contact">Contact</a>
                </nav>

                <div class="flex items-center gap-2 text-sm">
                    @foreach($locales as $l)
                        <a
                            href="/{{ $l }}"
                            class="px-2 py-1 rounded-lg border transition-all {{ $l === $locale ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-blue-600' : 'border-blue-200 hover:border-blue-400 hover:bg-blue-50' }}"
                        >
                            {{ strtoupper($l) }}
                        </a>
                    @endforeach
                </div>

                <a
                    href="{{ $cta['booking_url'] ?? '#' }}"
                    class="inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg hover:shadow-xl transition-all hover:scale-105"
                >
                    Book free assessment
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="mx-auto max-w-6xl px-4 py-24">
            <div class="grid gap-12 md:grid-cols-2 md:items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 px-4 py-2 text-sm font-semibold text-blue-800">
                        🎯 FrenchBoost
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Boost your French,<br>Boost your potential.
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Online French tutoring designed to help learners build confidence and meaningful progress through personalized lessons and proven methods.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a
                            href="{{ $cta['booking_url'] ?? '#' }}"
                            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-xl hover:shadow-2xl transition-all hover:scale-105"
                        >
                            Book a free assessment
                        </a>
                        <a
                            href="#pricing"
                            class="inline-flex items-center justify-center rounded-xl border-2 border-blue-200 bg-white/80 backdrop-blur px-6 py-3 text-base font-semibold text-blue-600 hover:border-blue-400 hover:bg-blue-50 transition-all"
                        >
                            See pricing
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-3xl transform rotate-3 opacity-20"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-blue-100">
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
                                <p class="text-slate-700 italic">"{{ $t['body'] }}"</p>
                                <div class="flex items-center justify-between">
                                    <cite class="font-semibold text-slate-900 not-italic">{{ $t['name'] }}</cite>
                                    <span class="text-sm text-slate-500">{{ str_repeat('★', (int) ($t['rating'] ?? 0)) }}</span>
                                </div>
                            </blockquote>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="mx-auto max-w-6xl px-4 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                    {{ $about['title'] }}
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Meet your dedicated French tutor and discover the personalized approach that sets FrenchBoost apart
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
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-blue-100">
                        <p class="text-lg leading-relaxed text-slate-700 whitespace-pre-line">{{ $about['body'] }}</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">🎓</div>
                            <div>
                                <p class="font-semibold">Certified Instructor</p>
                                <p class="text-sm text-slate-600">Professional French teaching credentials</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">💝</div>
                            <div>
                                <p class="font-semibold">Passionate Teaching</p>
                                <p class="text-sm text-slate-600">Dedicated to student success</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="strategy" class="bg-white/50 backdrop-blur-sm py-20">
            <div class="mx-auto max-w-6xl px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                        {{ $strategy['title'] }}
                    </h2>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                        Our proven methodology combines traditional techniques with modern learning approaches
                    </p>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    @foreach(($strategy['items'] ?? []) as $index => $item)
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r {{ $index === 0 ? 'from-blue-400 to-cyan-400' : ($index === 1 ? 'from-indigo-400 to-purple-400' : 'from-purple-400 to-pink-400') }} rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                            <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 hover:shadow-xl transition-shadow">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-r {{ $index === 0 ? 'from-blue-500 to-cyan-500' : ($index === 1 ? 'from-indigo-500 to-purple-500' : 'from-purple-500 to-pink-500') }} flex items-center justify-center text-white text-2xl mb-6">
                                    {{ $index === 0 ? '🎯' : ($index === 1 ? '📚' : '🚀') }}
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $item['title'] }}</h3>
                                <p class="text-slate-600 leading-relaxed">{{ $item['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                    {{ $benefits['title'] }}
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Discover the advantages that make FrenchBoost the ideal choice for your French learning journey
                </p>
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach(($benefits['items'] ?? []) as $index => $item)
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-blue-100 hover:shadow-xl transition-all">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-r {{ $index === 0 ? 'from-green-500 to-emerald-500' : ($index === 1 ? 'from-blue-500 to-indigo-500' : 'from-purple-500 to-pink-500') }} flex items-center justify-center text-white text-xl mb-6">
                                {{ $index === 0 ? '⚡' : ($index === 1 ? '🎯' : '💎') }}
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $item['title'] }}</h3>
                            <p class="text-slate-600 leading-relaxed">{{ $item['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

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
                                            Most Popular
                                        </span>
                                    </div>
                                @endif
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $package['name'] }}</h3>
                                <div class="mb-6">
                                    <span class="text-3xl font-bold text-blue-600">${{ $package['price'] ?? '0' }}</span>
                                    <span class="text-slate-600">/session</span>
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
                                    Choose {{ $package['name'] }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="faq" class="mx-auto max-w-4xl px-4 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                    {{ $faq['title'] }}
                </h2>
                <p class="text-lg text-slate-600">
                    Find answers to common questions about French tutoring
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

        <section id="contact" class="bg-gradient-to-br from-blue-50 to-indigo-50 py-20">
            <div class="mx-auto max-w-4xl px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                        {{ $contact['title'] }}
                    </h2>
                    <p class="text-lg text-slate-600">
                        Ready to start your French learning journey? Get in touch today!
                    </p>
                </div>
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-blue-100">
                    <div class="grid gap-8 md:grid-cols-2">
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">📧</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Email</p>
                                    <p class="text-slate-600">{{ $contact['email'] ?? 'contact@frenchboost.com' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">📱</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Phone</p>
                                    <p class="text-slate-600">{{ $contact['phone'] ?? '+1 (555) 123-4567' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="font-semibold text-slate-900">Send us a message</h3>
                            <form class="space-y-4">
                                <input type="text" placeholder="Your name" class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:border-blue-500 focus:outline-none">
                                <input type="email" placeholder="Your email" class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:border-blue-500 focus:outline-none">
                                <textarea placeholder="Your message" rows="4" class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:border-blue-500 focus:outline-none resize-none"></textarea>
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl hover:shadow-lg transition-all hover:scale-105">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white/80 backdrop-blur-md border-t border-blue-100">
        <div class="mx-auto max-w-6xl px-4 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-600">
                    © {{ date('Y') }} {{ $brand['name'] ?? 'FrenchBoost' }} - Empowering French learners worldwide
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">Privacy</a>
                    <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">Terms</a>
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">📘</a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">🐦</a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">📷</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
