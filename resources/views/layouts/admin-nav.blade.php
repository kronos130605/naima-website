@php
    $locale = app()->getLocale();
    $tabs = config('frenchboost.admin_nav');
@endphp

<nav class="border-b border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-0.5 overflow-x-auto scrollbar-none -mb-px">
            @foreach($tabs as $tab)
                @php
                    $isActive = \Illuminate\Support\Str::is($tab['pattern'], request()->route()?->getName() ?? '');
                @endphp
                <a
                    href="{{ route($tab['route'], ['locale' => $locale]) }}"
                    class="group flex items-center gap-2 whitespace-nowrap px-4 py-3.5 text-sm font-medium border-b-2 transition-colors {{ $isActive
                        ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}"
                >
                    {!! $tab['icon'] !!}
                    {{ __('admin.nav.' . $tab['label_key']) }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
