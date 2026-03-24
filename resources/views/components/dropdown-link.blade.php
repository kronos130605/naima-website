@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';

    $classes = $isNewDesign
        ? 'block w-full px-4 py-2.5 text-start text-base leading-5 font-bold text-slate-900 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 transition-all hover:scale-105 rounded-xl dark:text-slate-100 dark:hover:bg-blue-900/30'
        : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
