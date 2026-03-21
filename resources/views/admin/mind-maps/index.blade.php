<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Mind Maps
            </h2>
            <a
                href="{{ route('admin.mind-maps.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Mind Map
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Flash --}}
            @if(session('success'))
                <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats --}}
            @php
                $groupLabels = [
                    'maternelle' => 'Maternelle',
                    'primaire'   => 'Primaire',
                    'college'    => 'Collège',
                    'lycee'      => 'Lycée',
                ];
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
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
                <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                    <p class="text-2xl font-extrabold text-blue-600">{{ $stats['groups'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Groups</p>
                </div>
            </div>

            {{-- Group filter --}}
            <div class="flex flex-wrap items-center gap-2">
                <a
                    href="{{ request()->url() }}"
                    class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_group === '' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
                >All</a>
                @foreach($groups as $key)
                    <a
                        href="{{ request()->url() . '?group=' . $key }}"
                        class="rounded-full px-3.5 py-1.5 text-xs font-semibold border transition-colors {{ $current_group === $key ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300 hover:text-blue-600 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600' }}"
                    >{{ $groupLabels[$key] ?? $key }}</a>
                @endforeach
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                @if($maps->count())
                    <table class="w-full text-sm">
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40">
                            <tr>
                                <th class="px-5 py-3 text-left">Title</th>
                                <th class="px-3 py-3 text-left">Group</th>
                                <th class="px-3 py-3 text-left">Level</th>
                                <th class="px-3 py-3 text-left">Topic</th>
                                <th class="px-3 py-3 text-center">Preview</th>
                                <th class="px-3 py-3 text-center">PDF</th>
                                <th class="px-3 py-3 text-center">Status</th>
                                <th class="px-3 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                            @foreach($maps as $map)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors">
                                    <td class="px-5 py-3">
                                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $map->title_en }}</p>
                                        <p class="text-xs text-gray-400">{{ $map->title_fr }}</p>
                                    </td>
                                    <td class="px-3 py-3">
                                        <span class="rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-bold px-2 py-0.5">
                                            {{ $groupLabels[$map->group] ?? $map->group }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <span class="rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold px-2 py-0.5">
                                            {{ $map->level }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ $map->topic_en }}</td>
                                    <td class="px-3 py-3 text-center">
                                        @if($map->preview_image)
                                            <img src="{{ Storage::url($map->preview_image) }}" class="h-10 w-14 object-cover rounded mx-auto" alt="">
                                        @else
                                            <span class="text-gray-300 dark:text-gray-600">—</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        @if($map->file_path)
                                            <span class="text-green-600 dark:text-green-400 font-bold" title="PDF ready">✓</span>
                                        @else
                                            <span class="text-gray-300 dark:text-gray-600">—</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <form method="POST" action="{{ route('admin.mind-maps.toggle', ['mindMap' => $map]) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors {{ $map->is_published ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                                {{ $map->is_published ? 'Published' : 'Draft' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-3 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.mind-maps.edit', ['mindMap' => $map]) }}" class="rounded-lg px-2.5 py-1 text-xs font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-950/30 transition-colors border border-blue-200 dark:border-blue-800">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.mind-maps.destroy', ['mindMap' => $map]) }}" onsubmit="return confirm('Delete this mind map?')">
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

                    {{-- Pagination --}}
                    @if($maps->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $maps->links() }}
                        </div>
                    @endif
                @else
                    <div class="py-16 text-center">
                        <div class="text-5xl mb-4">🗺</div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No mind maps found.</p>
                        <a href="{{ route('admin.mind-maps.create') }}" class="mt-4 inline-block text-blue-600 text-sm font-medium hover:underline">Create your first one →</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
