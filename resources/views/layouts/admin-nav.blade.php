@php
    $locale = app()->getLocale();
    $tabs = [
        [
            'label'   => 'Dashboard',
            'icon'    => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
            'route'   => 'dashboard',
            'params'  => ['locale' => $locale],
            'pattern' => 'dashboard',
        ],
        [
            'label'   => 'Mind Maps',
            'icon'    => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
            'route'   => 'admin.mind-maps.index',
            'params'  => ['locale' => $locale],
            'pattern' => 'admin.mind-maps.*',
        ],
    ];
@endphp

<nav class="border-b border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-0.5 overflow-x-auto scrollbar-none -mb-px">
            @foreach($tabs as $tab)
                @php
                    $isActive = \Illuminate\Support\Str::is($tab['pattern'], request()->route()?->getName() ?? '');
                @endphp
                <a
                    href="{{ route($tab['route'], $tab['params']) }}"
                    class="group flex items-center gap-2 whitespace-nowrap px-4 py-3.5 text-sm font-medium border-b-2 transition-colors {{ $isActive
                        ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}"
                >
                    {!! $tab['icon'] !!}
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
