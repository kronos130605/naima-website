<div class="py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('admin.dashboard.welcome') }}
        </p>

        {{-- Content management --}}
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-3">{{ __('admin.dashboard.content') }}</h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a
                    href="{{ route('admin.mind-maps.index', ['locale' => app()->getLocale()]) }}"
                    hx-get="{{ route('admin.mind-maps.index', ['locale' => app()->getLocale()]) }}"
                    hx-target="#admin-content"
                    hx-swap="innerHTML"
                    hx-push-url="true"
                    class="group flex items-start gap-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                >
                    <div class="text-3xl">🗺</div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('admin.nav.mind_maps') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.dashboard.mind_maps_desc') }}</p>
                    </div>
                </a>
                <a
                    href="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}"
                    hx-get="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}"
                    hx-target="#admin-content"
                    hx-swap="innerHTML"
                    hx-push-url="true"
                    class="group flex items-start gap-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                >
                    <div class="text-3xl">🎬</div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('admin.nav.videos') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.dashboard.videos_desc') }}</p>
                    </div>
                </a>
                <a
                    href="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}"
                    hx-get="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}"
                    hx-target="#admin-content"
                    hx-swap="innerHTML"
                    hx-push-url="true"
                    class="group flex items-start gap-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                >
                    <div class="text-3xl">📄</div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('admin.nav.worksheets') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.dashboard.worksheets_desc') }}</p>
                    </div>
                </a>
                <a
                    href="{{ route('admin.bookings.index', ['locale' => app()->getLocale()]) }}"
                    hx-get="{{ route('admin.bookings.index', ['locale' => app()->getLocale()]) }}"
                    hx-target="#admin-content"
                    hx-swap="innerHTML"
                    hx-push-url="true"
                    class="group flex items-start gap-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                >
                    <div class="text-3xl">📅</div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('admin.nav.bookings') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.dashboard.bookings_desc') }}</p>
                    </div>
                </a>
                <a
                    href="{{ route('admin.testimonials.index', ['locale' => app()->getLocale()]) }}"
                    hx-get="{{ route('admin.testimonials.index', ['locale' => app()->getLocale()]) }}"
                    hx-target="#admin-content"
                    hx-swap="innerHTML"
                    hx-push-url="true"
                    class="group flex items-start gap-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                >
                    <div class="text-3xl">💬</div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ __('Testimonials') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('Manage user testimonials') }}</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Quick links --}}
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-3">{{ __('admin.dashboard.quick_links') }}</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('site.home', ['locale' => app()->getLocale()]) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ __('admin.dashboard.view_site') }}
                </a>
                <a href="{{ route('site.mind-maps', ['locale' => app()->getLocale()]) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ __('admin.dashboard.public_mind_maps') }}
                </a>
                <a href="{{ route('site.videos', ['locale' => app()->getLocale()]) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ __('admin.dashboard.public_videos') }}
                </a>
                <a href="{{ route('site.worksheets', ['locale' => app()->getLocale()]) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 dark:border-gray-700 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ __('admin.dashboard.public_worksheets') }}
                </a>
            </div>
        </div>

    </div>
</div>
