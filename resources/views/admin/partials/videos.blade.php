<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Videos</h2>
            <button
                hx-get="{{ route('admin.videos.create', ['locale' => app()->getLocale()]) }}"
                hx-target="#admin-modal-content"
                hx-swap="innerHTML"
                hx-select="#admin-form-content"
                onclick="document.getElementById('admin-modal-title').textContent='New Video'; window.dispatchEvent(new Event('open-admin-modal'))"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Video
            </button>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @php
            $levelLabels = [
                'beginner'     => 'Beginner (K–3)',
                'intermediate' => 'Intermediate (4–8)',
                'advanced'     => 'Advanced (9–12)',
                'general'      => 'General',
            ];
        @endphp

        {{-- Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Total</p>
            </div>
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-green-600">{{ $stats['published'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Published</p>
            </div>
            <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-amber-500">{{ $stats['total'] - $stats['published'] }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Drafts</p>
            </div>
        </div>

        {{-- Level filter --}}
        <div class="flex flex-wrap items-center gap-2">
            <a
                href="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}"
                hx-get="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}"
                hx-target="#admin-content" hx-swap="innerHTML" hx-push-url="true"
                class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_level === '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
            >All</a>
            @foreach($levels as $key)
                <a
                    href="{{ route('admin.videos.index', ['locale' => app()->getLocale(), 'level' => $key]) }}"
                    hx-get="{{ route('admin.videos.index', ['locale' => app()->getLocale(), 'level' => $key]) }}"
                    hx-target="#admin-content" hx-swap="innerHTML" hx-push-url="true"
                    class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_level === $key ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
                >{{ $levelLabels[$key] ?? $key }}</a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            @if($videos->count())
                <table class="w-full text-sm">
                    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40">
                        <tr>
                            <th class="px-5 py-3 text-left">Title</th>
                            <th class="px-3 py-3 text-left">Level</th>
                            <th class="px-3 py-3 text-left">Topic</th>
                            <th class="px-3 py-3 text-center">Thumbnail</th>
                            <th class="px-3 py-3 text-center">Status</th>
                            <th class="px-3 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @foreach($videos as $video)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ $video->title_en }}</p>
                                    <p class="text-xs text-gray-400">{{ $video->title_fr }}</p>
                                </td>
                                <td class="px-3 py-3">
                                    <span class="rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold px-2 py-0.5">
                                        {{ $levelLabels[$video->level] ?? $video->level }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-gray-500 dark:text-gray-400 text-xs">
                                    {{ $video->topic_en }}
                                    @php $src = $video->videoSource(); @endphp
                                    <span class="mt-1 inline-block rounded px-1.5 py-0.5 text-[10px] font-bold
                                        {{ $src === 'youtube' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' : ($src === 'vimeo' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-300' : 'bg-gray-100 text-gray-500') }}">
                                        {{ strtoupper($src) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <img
                                        src="{{ $video->thumbnailUrl() }}"
                                        class="h-10 w-16 object-cover rounded mx-auto"
                                        alt=""
                                        loading="lazy"
                                    >
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.videos.toggle', ['locale' => app()->getLocale(), 'video' => $video]) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors {{ $video->is_published ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                            {{ $video->is_published ? 'Published' : 'Draft' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-3 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            hx-get="{{ route('admin.videos.edit', ['locale' => app()->getLocale(), 'video' => $video]) }}"
                                            hx-target="#admin-modal-content"
                                            hx-swap="innerHTML"
                                            hx-select="#admin-form-content"
                                            onclick="document.getElementById('admin-modal-title').textContent='Edit Video'; window.dispatchEvent(new Event('open-admin-modal'))"
                                            class="rounded-lg px-2.5 py-1 text-xs font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-950/30 transition-colors border border-blue-200 dark:border-blue-800"
                                        >
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.videos.destroy', ['locale' => app()->getLocale(), 'video' => $video]) }}" onsubmit="return confirm('Delete this video?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1 text-xs font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30 transition-colors border border-red-200 dark:border-red-800">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($videos->hasPages())
                    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $videos->links() }}
                    </div>
                @endif
            @else
                <div class="py-16 text-center">
                    <div class="text-5xl mb-4">🎬</div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No videos found.</p>
                    <button
                        hx-get="{{ route('admin.videos.create', ['locale' => app()->getLocale()]) }}"
                        hx-target="#admin-modal-content"
                        hx-swap="innerHTML"
                        hx-select="#admin-form-content"
                        onclick="document.getElementById('admin-modal-title').textContent='New Video'; window.dispatchEvent(new Event('open-admin-modal'))"
                        class="mt-4 inline-block text-blue-600 text-sm font-medium hover:underline"
                    >Add your first video →</button>
                </div>
            @endif
        </div>

    </div>
</div>
