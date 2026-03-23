<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('site.page_title.home') }}</title>

    @vite(['resources/css/app.css', 'resources/js/theme.js', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 text-slate-900 min-h-screen">
    @php
        $path = request()->path();
        $segments = array_values(array_filter(explode('/', trim($path, '/')), fn ($s) => $s !== ''));
        $maybeLocale = $segments[0] ?? null;
        if ($maybeLocale && in_array($maybeLocale, $locales, true)) {
            array_shift($segments);
        }
        $pathWithoutLocale = implode('/', $segments);
        $localeFlag = [
            'en' => '🇨🇦',
            'fr' => '🇫🇷',
        ];
    @endphp

    <x-site.header
        :brand="$brand"
        :cta="$cta"
        :locale="$locale"
        :locales="$locales"
        :locale-flag="$localeFlag"
        :path-without-locale="$pathWithoutLocale"
    />

    <main>
        <x-site.hero :cta="$cta" :testimonials="$testimonials" :locale="$locale" />

        <x-site.stats :stats="$stats" />

        <x-site.about :about="$about" />

        <x-site.programs :programs="$programs" />

        <x-site.strategy :strategy="$strategy" />

        <x-site.benefits :benefits="$benefits" />

        <x-site.testimonials :testimonials="$testimonials" />

        <x-site.resources :resources="$resources" />

        <x-site.pricing :pricing="$pricing" :cta="$cta" :locale="$locale" />

        <x-site.faq :faq="$faq" />

        <x-site.contact :contact="$contact" />
    </main>

    <x-site.footer :brand="$brand" :locale="$locale" />
</body>
</html>
