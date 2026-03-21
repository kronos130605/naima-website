<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                🗺 Mind Maps
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

            {{-- Summary stats --}}
            @php
                $total     = collect($maps)->flatten(1)->count();
                $published = collect($maps)->flatten(1)->where('is_published', true)->count();
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $total }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Total maps</p>
                </div>
                <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                    <p class="text-2xl font-extrabold text-green-600">{{ $published }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Published</p>
                </div>
                <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                    <p class="text-2xl font-extrabold text-amber-500">{{ $total - $published }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Drafts</p>
                </div>
                <div class="rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-4 text-center shadow-sm">
                    <p class="text-2xl font-extrabold text-blue-600">{{ collect($maps)->count() }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Groups</p>
                </div>
            </div>

            {{-- Groups --}}
            @forelse($groups as $groupKey)
                @if(isset($maps[$groupKey]) && $maps[$groupKey]->count())
                    @php
                        $labels = [
                            'maternelle' => 'Maternelle / Kindergarten',
                            'primaire'   => 'Primaire / Elementary',
                            'college'    => 'Collège / Middle School',
                            'lycee'      => 'Lycée / High School',
                        ];
                    @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wide">
                                {{ $labels[$groupKey] ?? $groupKey }}
                            </h3>
                            <span class="text-xs text-gray-400">{{ $maps[$groupKey]->count() }} items</span>
                        </div>
                        <table class="w-full text-sm">
                            <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700">
                                <tr>
                                    <th class="px-5 py-2.5 text-left">Title</th>
                                    <th class="px-3 py-2.5 text-left">Level</th>
                                    <th class="px-3 py-2.5 text-left">Topic</th>
                                    <th class="px-3 py-2.5 text-center">Preview</th>
                                    <th class="px-3 py-2.5 text-center">PDF</th>
                                    <th class="px-3 py-2.5 text-center">Status</th>
                                    <th class="px-3 py-2.5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                                @foreach($maps[$groupKey]->sortBy('sort_order') as $map)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors">
                                        <td class="px-5 py-3">
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $map->title_en }}</p>
                                            <p class="text-xs text-gray-400">{{ $map->title_fr }}</p>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold px-2 py-0.5">
                                                {{ $map->level }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-3 text-gray-500 dark:text-gray-400 text-xs">
                                            {{ $map->topic_en }}
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            @if($map->preview_image)
                                                <img src="{{ Storage::url($map->preview_image) }}" class="h-10 w-14 object-cover rounded mx-auto" alt="">
                                            @else
                                                <span class="text-gray-300 dark:text-gray-600 text-lg">—</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            @if($map->file_path)
                                                <span class="text-green-600 dark:text-green-400 text-lg" title="PDF ready">✓</span>
                                            @else
                                                <span class="text-gray-300 dark:text-gray-600 text-lg">—</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            <form method="POST" action="{{ route('admin.mind-maps.toggle', $map) }}">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors {{ $map->is_published ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                                    {{ $map->is_published ? 'Published' : 'Draft' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-3 py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('admin.mind-maps.edit', $map) }}" class="rounded-lg px-2.5 py-1 text-xs font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-950/30 transition-colors border border-blue-200 dark:border-blue-800">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.mind-maps.destroy', $map) }}" onsubmit="return confirm('Delete this mind map?')">
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
                    </div>
                @endif
            @empty
                <div class="rounded-2xl bg-white dark:bg-gray-800 border border-dashed border-gray-300 dark:border-gray-600 p-16 text-center">
                    <div class="text-5xl mb-4">🗺</div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No mind maps yet.</p>
                    <a href="{{ route('admin.mind-maps.create') }}" class="mt-4 inline-block text-blue-600 text-sm font-medium hover:underline">Create your first one →</a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
