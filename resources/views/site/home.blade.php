<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $brand['name'] ?? 'FrenchBoost' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900">
    <header class="border-b">
        <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between gap-4">
            <a href="/{{ $locale }}" class="font-semibold text-lg">
                {{ $brand['name'] ?? 'FrenchBoost' }}
            </a>

            <div class="flex items-center gap-3">
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a class="hover:underline" href="#about">About</a>
                    <a class="hover:underline" href="#strategy">Strategy</a>
                    <a class="hover:underline" href="#pricing">Pricing</a>
                    <a class="hover:underline" href="#faq">FAQ</a>
                    <a class="hover:underline" href="#contact">Contact</a>
                </nav>

                <div class="flex items-center gap-2 text-sm">
                    @foreach($locales as $l)
                        <a
                            href="/{{ $l }}"
                            class="px-2 py-1 rounded border {{ $l === $locale ? 'bg-slate-900 text-white border-slate-900' : 'border-slate-200' }}"
                        >
                            {{ strtoupper($l) }}
                        </a>
                    @endforeach
                </div>

                <a
                    href="{{ $cta['booking_url'] ?? '#' }}"
                    class="inline-flex items-center justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white"
                >
                    Book free assessment
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="mx-auto max-w-6xl px-4 py-16">
            <div class="grid gap-10 md:grid-cols-2 md:items-center">
                <div>
                    <p class="text-sm font-semibold tracking-wide text-slate-500">FrenchBoost</p>
                    <h1 class="mt-2 text-4xl font-semibold tracking-tight">
                        Boost your French, Boost your potential.
                    </h1>
                    <p class="mt-4 text-slate-600">
                        Online French tutoring designed to help learners build confidence and meaningful progress.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a
                            href="{{ $cta['booking_url'] ?? '#' }}"
                            class="inline-flex items-center justify-center rounded-md bg-slate-900 px-5 py-3 text-sm font-medium text-white"
                        >
                            Book a free assessment
                        </a>
                        <a
                            href="#pricing"
                            class="inline-flex items-center justify-center rounded-md border border-slate-200 px-5 py-3 text-sm font-medium"
                        >
                            See pricing
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 p-6">
                    <h2 class="text-sm font-semibold text-slate-700">Review from happy customer</h2>
                    @foreach(($testimonials['items'] ?? []) as $t)
                        <div class="mt-4 rounded-xl bg-slate-50 p-4">
                            <div class="flex items-center justify-between">
                                <p class="font-medium">{{ $t['name'] }}</p>
                                <p class="text-sm text-slate-500">{{ str_repeat('★', (int) ($t['rating'] ?? 0)) }}</p>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">{{ $t['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="about" class="mx-auto max-w-6xl px-4 py-16 border-t">
            <div class="grid gap-8 md:grid-cols-3">
                <div class="md:col-span-1">
                    <div class="aspect-square w-full max-w-[220px] rounded-2xl bg-slate-100"></div>
                    <p class="mt-2 text-xs text-slate-500">Avatar</p>
                </div>
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-semibold">{{ $about['title'] }}</h2>
                    <p class="mt-4 whitespace-pre-line text-slate-700">{{ $about['body'] }}</p>
                </div>
            </div>
        </section>

        <section id="strategy" class="mx-auto max-w-6xl px-4 py-16 border-t">
            <h2 class="text-2xl font-semibold">{{ $strategy['title'] }}</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach(($strategy['items'] ?? []) as $item)
                    <div class="rounded-2xl border border-slate-200 p-6">
                        <p class="text-sm font-semibold text-slate-500">{{ $item['title'] }}</p>
                        <p class="mt-3 text-sm text-slate-700">{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 py-16 border-t">
            <h2 class="text-2xl font-semibold">{{ $benefits['title'] }}</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach(($benefits['items'] ?? []) as $item)
                    <div class="rounded-2xl bg-slate-50 p-6">
                        <p class="font-semibold">{{ $item['title'] }}</p>
                        <p class="mt-2 text-sm text-slate-700">{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="pricing" class="mx-auto max-w-6xl px-4 py-16 border-t">
            <h2 class="text-2xl font-semibold">{{ $pricing['title'] }}</h2>
            <p class="mt-2 text-slate-600">{{ $pricing['subtitle'] }}</p>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach(($pricing['packages'] ?? []) as $package)
                    <div class="rounded-2xl border border-slate-200 p-6">
                        <p class="font-semibold">{{ $package['name'] }}</p>
                        <ul class="mt-3 space-y-2 text-sm text-slate-700">
                            @foreach(($package['details'] ?? []) as $d)
                                <li>{{ $d }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="faq" class="mx-auto max-w-6xl px-4 py-16 border-t">
            <h2 class="text-2xl font-semibold">{{ $faq['title'] }}</h2>
            <div class="mt-8 space-y-3">
                @foreach(($faq['items'] ?? []) as $item)
                    <details class="rounded-xl border border-slate-200 p-4">
                        <summary class="cursor-pointer font-medium">{{ $item['q'] }}</summary>
                        <p class="mt-3 text-sm text-slate-700">{{ $item['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </section>

        <section id="contact" class="mx-auto max-w-6xl px-4 py-16 border-t">
            <h2 class="text-2xl font-semibold">{{ $contact['title'] }}</h2>
            <div class="mt-6 rounded-2xl bg-slate-50 p-6">
                <p class="text-sm text-slate-700">Email: {{ $contact['email'] ?? 'TBD' }}</p>
                <p class="mt-2 text-sm text-slate-700">Phone: {{ $contact['phone'] ?? 'TBD' }}</p>
            </div>
        </section>
    </main>

    <footer class="border-t">
        <div class="mx-auto max-w-6xl px-4 py-10 text-sm text-slate-500">
            © {{ date('Y') }} {{ $brand['name'] ?? 'FrenchBoost' }}
        </div>
    </footer>
</body>
</html>
