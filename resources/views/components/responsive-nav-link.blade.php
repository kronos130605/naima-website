@props(['active'])

@php
$designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
$isNewDesign = $designTheme === 'new';

$classes = ($active ?? false)
            ? ($isNewDesign
                ? 'block w-full ps-4 pe-4 py-3 border-l-8 border-purple-500 text-start text-base font-black text-purple-700 bg-purple-100 focus:outline-none focus:text-purple-800 focus:bg-purple-200 rounded-r-2xl transition-all hover:scale-105 shadow-lg dark:text-purple-300 dark:bg-purple-900/30 dark:border-purple-400'
                : 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            )
            : ($isNewDesign
                ? 'block w-full ps-4 pe-4 py-3 border-l-8 border-transparent text-start text-base font-bold text-slate-700 hover:text-blue-900 hover:bg-blue-100 hover:border-blue-400 focus:outline-none rounded-r-2xl transition-all hover:scale-105 dark:text-slate-200 dark:hover:text-blue-300 dark:hover:bg-blue-900/30'
                : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out'
            );
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
