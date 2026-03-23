<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ __('admin.worksheets.title') }}</h2>
            <button
                hx-get="{{ route('admin.worksheets.create', ['locale' => app()->getLocale()]) }}"
                hx-target="#admin-modal-content"
                hx-swap="innerHTML"
                hx-select="#admin-form-content"
                onclick="document.getElementById('admin-modal-title').textContent='{{ __('admin.worksheets.new_worksheet') }}'; window.dispatchEvent(new Event('open-admin-modal'))"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('admin.worksheets.new_worksheet') }}
            </button>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @php
            $levelLabels = config('frenchboost.levels');
        @endphp

        {{-- Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.common.total') }}</p>
            </div>
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-green-600">{{ $stats['published'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.common.published') }}</p>
            </div>
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-amber-500">{{ $stats['total'] - $stats['published'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ __('admin.common.drafts') }}</p>
            </div>
        </div>

        {{-- Level filter --}}
        <div class="flex flex-wrap items-center gap-2">
            <a
                href="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}"
                hx-get="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}"
                hx-target="#admin-content" hx-swap="innerHTML" hx-push-url="true"
                class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_level === '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
            >{{ __('admin.common.all') }}</a>
            @foreach($levels as $key)
                <a
                    href="{{ route('admin.worksheets.index', ['locale' => app()->getLocale(), 'level' => $key]) }}"
                    hx-get="{{ route('admin.worksheets.index', ['locale' => app()->getLocale(), 'level' => $key]) }}"
                    hx-target="#admin-content" hx-swap="innerHTML" hx-push-url="true"
                    class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_level === $key ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
                >{{ $levelLabels[$key] ?? $key }}</a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            @if($worksheets->count())
                <table class="w-full text-sm">
                    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40">
                        <tr>
                            <th class="px-5 py-3 text-left">{{ __('admin.worksheets.table_title') }}</th>
                            <th class="px-3 py-3 text-left">{{ __('admin.worksheets.table_level') }}</th>
                            <th class="px-3 py-3 text-left">{{ __('admin.worksheets.table_topic') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('admin.worksheets.table_preview') }}</th>
                            <th class="px-3 py-3 text-center">PDF</th>
                            <th class="px-3 py-3 text-center">{{ __('admin.common.status') }}</th>
                            <th class="px-3 py-3 text-right">{{ __('admin.common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @foreach($worksheets as $worksheet)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ $worksheet->title_en }}</p>
                                    <p class="text-xs text-gray-400">{{ $worksheet->title_fr }}</p>
                                </td>
                                <td class="px-3 py-3">
                                    <span class="rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-xs font-bold px-2 py-0.5">
                                        {{ $levelLabels[$worksheet->level] ?? $worksheet->level }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ $worksheet->topic_en }}</td>
                                <td class="px-3 py-3 text-center">
                                    @if($worksheet->preview_image)
                                        <img src="{{ Storage::url($worksheet->preview_image) }}" class="h-10 w-14 object-cover rounded mx-auto" alt="">
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3 text-center">
                                    @if($worksheet->file_path)
                                        <span class="text-green-600 dark:text-green-400 font-bold" title="PDF ready">✓</span>
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.worksheets.toggle', ['locale' => app()->getLocale(), 'worksheet' => $worksheet]) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors {{ $worksheet->is_published ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                            {{ $worksheet->is_published ? __('admin.common.published') : __('admin.common.draft') }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-3 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            hx-get="{{ route('admin.worksheets.edit', ['locale' => app()->getLocale(), 'worksheet' => $worksheet]) }}"
                                            hx-target="#admin-modal-content"
                                            hx-swap="innerHTML"
                                            hx-select="#admin-form-content"
                                            onclick="document.getElementById('admin-modal-title').textContent='{{ __('admin.worksheets.edit_worksheet') }}'; window.dispatchEvent(new Event('open-admin-modal'))"
                                            class="rounded-lg px-2.5 py-1 text-xs font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-950/30 transition-colors border border-blue-200 dark:border-blue-800"
                                        >
                                            {{ __('admin.common.edit') }}
                                        </button>
                                        <form method="POST" action="{{ route('admin.worksheets.destroy', ['locale' => app()->getLocale(), 'worksheet' => $worksheet]) }}" onsubmit="return confirm('{{ __('admin.worksheets.delete_confirm') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1 text-xs font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30 transition-colors border border-red-200 dark:border-red-800">
                                                {{ __('admin.common.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($worksheets->hasPages())
                    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $worksheets->links() }}
                    </div>
                @endif
            @else
                <div class="py-16 text-center">
                    <div class="text-5xl mb-4">📄</div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('admin.worksheets.no_worksheets') }}</p>
                    <button
                        hx-get="{{ route('admin.worksheets.create', ['locale' => app()->getLocale()]) }}"
                        hx-target="#admin-modal-content"
                        hx-swap="innerHTML"
                        hx-select="#admin-form-content"
                        onclick="document.getElementById('admin-modal-title').textContent='{{ __('admin.worksheets.new_worksheet') }}'; window.dispatchEvent(new Event('open-admin-modal'))"
                        class="mt-4 inline-block text-blue-600 text-sm font-medium hover:underline"
                    >{{ __('admin.worksheets.add_first') }}</button>
                </div>
            @endif
        </div>

    </div>
</div>
