<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative dark:bg-green-900/30 dark:border-green-600 dark:text-green-300" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">{{ __('Testimonial Posts') }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Manage visibility and order of testimonials submitted by users.') }}
                                </p>
                            </div>

                            <form
                                method="GET"
                                action="{{ route('admin.testimonials.index', ['locale' => app()->getLocale()]) }}"
                                hx-get="{{ route('admin.testimonials.index', ['locale' => app()->getLocale()]) }}"
                                hx-target="#admin-content"
                                hx-swap="innerHTML"
                                class="flex items-center gap-2"
                            >
                                <label for="locale_filter" class="text-sm text-gray-600 dark:text-gray-300">{{ __('Language') }}</label>
                                <select
                                    id="locale_filter"
                                    name="locale_filter"
                                    class="h-9 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onchange="this.form.requestSubmit()"
                                >
                                    <option value="" {{ empty($localeFilter) ? 'selected' : '' }}>{{ __('All') }}</option>
                                    <option value="en" {{ ($localeFilter ?? '') === 'en' ? 'selected' : '' }}>EN</option>
                                    <option value="fr" {{ ($localeFilter ?? '') === 'fr' ? 'selected' : '' }}>FR</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    @if($posts->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400">{{ __('No testimonials yet.') }}</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Order') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Rating') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Testimonial') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Role') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('User') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Visible') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach($posts as $post)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 w-28">
                                                <div class="flex items-center gap-1">
                                                    <form method="POST" action="{{ route('admin.testimonials.up', ['locale' => app()->getLocale(), 'testimonialPost' => $post->id]) }}">
                                                        @csrf
                                                        <input type="hidden" name="locale_filter" value="{{ $localeFilter ?? '' }}">
                                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-md border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700" title="{{ __('Move up') }}">
                                                            ↑
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.testimonials.down', ['locale' => app()->getLocale(), 'testimonialPost' => $post->id]) }}">
                                                        @csrf
                                                        <input type="hidden" name="locale_filter" value="{{ $localeFilter ?? '' }}">
                                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-md border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700" title="{{ __('Move down') }}">
                                                            ↓
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $post->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ strtoupper($post->locale ?? '') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-yellow-500">
                                                    @for($i = 0; $i < $post->rating; $i++)
                                                        ★
                                                    @endfor
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-gray-100 whitespace-normal break-words">
                                                    {{ $post->body }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-500 dark:text-gray-400 whitespace-normal break-words">
                                                    {{ $post->role ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post->user->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('admin.testimonials.toggle', ['locale' => app()->getLocale(), 'testimonialPost' => $post->id]) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="locale_filter" value="{{ $localeFilter ?? '' }}">
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md {{ $post->is_visible ? 'text-white bg-green-600 hover:bg-green-700' : 'text-gray-700 bg-gray-200 hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{ $post->is_visible ? __('Visible') : __('Hidden') }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form method="POST" action="{{ route('admin.testimonials.destroy', ['locale' => app()->getLocale(), 'testimonialPost' => $post->id]) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete this testimonial?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="locale_filter" value="{{ $localeFilter ?? '' }}">
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
