@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-8 border-purple-500 text-start text-base font-black text-purple-700 bg-purple-100 focus:outline-none focus:text-purple-800 focus:bg-purple-200 rounded-r-2xl transition-all hover:scale-105 shadow-lg dark:text-purple-300 dark:bg-purple-900/30 dark:border-purple-400'
            : 'block w-full ps-4 pe-4 py-3 border-l-8 border-transparent text-start text-base font-bold text-slate-700 hover:text-blue-900 hover:bg-blue-100 hover:border-blue-400 focus:outline-none rounded-r-2xl transition-all hover:scale-105 dark:text-slate-200 dark:hover:text-blue-300 dark:hover:bg-blue-900/30';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
