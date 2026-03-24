@props([
    'title'   => 'FrenchBoost',
    'brand'   => [],
    'cta'     => [],
    'locale'  => 'en',
    'locales' => ['en', 'fr'],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $locale) }}" class="theme-{{ auth()->check() ? auth()->user()->getThemePreference() : \App\Models\SiteSetting::get('default_theme', 'new') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/theme.js', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900 min-h-screen dark:bg-slate-950 dark:text-slate-100">
    @php
        $path = request()->path();
        $segments = array_values(array_filter(explode('/', trim($path, '/')), fn ($s) => $s !== ''));
        $maybeLocale = $segments[0] ?? null;
        if ($maybeLocale && in_array($maybeLocale, $locales, true)) {
            array_shift($segments);
        }
        $pathWithoutLocale = implode('/', $segments);
        $localeFlag = ['en' => '🇨🇦', 'fr' => '🇫🇷'];
    @endphp

    <x-site.header
        :brand="$brand"
        :cta="$cta"
        :locale="$locale"
        :locales="$locales"
        :locale-flag="$localeFlag"
        :path-without-locale="$pathWithoutLocale"
    />

    {{ $slot }}

    <x-site.footer :brand="$brand" :locale="$locale" />
</body>
</html>
