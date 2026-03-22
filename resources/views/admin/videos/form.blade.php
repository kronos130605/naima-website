<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $video ? 'Edit: ' . $video->title_en : 'New Video' }}
            </h2>
        </div>
    </x-slot>

    <div id="admin-form-content" class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 px-4 py-3 text-sm text-red-700 dark:text-red-300">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ $video
                    ? route('admin.videos.update', ['locale' => app()->getLocale(), 'video' => $video])
                    : route('admin.videos.store', ['locale' => app()->getLocale()]) }}"
                class="space-y-6"
            >
                @csrf
                @if($video) @method('PUT') @endif

                {{-- Titles & Descriptions --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Titles & Descriptions</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title EN <span class="text-red-500">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en', $video?->title_en) }}" required placeholder="e.g. Passé Composé explained"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title FR <span class="text-red-500">*</span></label>
                            <input type="text" name="title_fr" value="{{ old('title_fr', $video?->title_fr) }}" required placeholder="e.g. Le Passé Composé expliqué"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description EN</label>
                            <textarea name="description_en" rows="3" placeholder="Short description..."
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_en', $video?->description_en) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description FR</label>
                            <textarea name="description_fr" rows="3" placeholder="Description courte..."
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_fr', $video?->description_fr) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Video Source --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Video</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Video URL <span class="text-red-500">*</span></label>
                        <input type="url" name="video_url" value="{{ old('video_url', $video?->video_url) }}" required
                            placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..."
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-400">Accepts YouTube (youtube.com/watch, youtu.be, /shorts/) and Vimeo (vimeo.com/...) links.</p>
                    </div>
                    @if($video?->embedUrl())
                        <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 aspect-video">
                            <iframe
                                src="{{ $video->embedUrl() }}"
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                        </div>
                    @endif
                </div>

                {{-- Classification --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Classification</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level <span class="text-red-500">*</span></label>
                            <select name="level" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach(['beginner' => 'Beginner (K–3)', 'intermediate' => 'Intermediate (4–8)', 'advanced' => 'Advanced (9–12)', 'general' => 'General'] as $key => $label)
                                    <option value="{{ $key }}" {{ old('level', $video?->level) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $video?->sort_order ?? 0) }}" min="0"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Topic EN</label>
                            <input type="text" name="topic_en" value="{{ old('topic_en', $video?->topic_en) }}" list="topic-en-list" placeholder="e.g. Conjugation"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <datalist id="topic-en-list">
                                <option>Grammar</option><option>Conjugation</option><option>Vocabulary</option>
                                <option>Reading</option><option>Writing</option><option>Phonics</option><option>Pronunciation</option>
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Topic FR</label>
                            <input type="text" name="topic_fr" value="{{ old('topic_fr', $video?->topic_fr) }}" list="topic-fr-list" placeholder="e.g. Conjugaison"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <datalist id="topic-fr-list">
                                <option>Grammaire</option><option>Conjugaison</option><option>Vocabulaire</option>
                                <option>Lecture</option><option>Écriture</option><option>Phonétique</option><option>Prononciation</option>
                            </datalist>
                        </div>
                    </div>
                </div>

                {{-- Settings --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" id="is_published" value="1"
                            {{ old('is_published', $video?->is_published ?? false) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_published" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Published (visible to the public)
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between gap-4 pt-2 pb-8">
                    @if(request()->header('HX-Request'))
                        <button type="button" onclick="window.dispatchEvent(new Event('close-admin-modal'))"
                            class="rounded-lg border border-gray-300 dark:border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            Cancel
                        </button>
                    @else
                        <a href="{{ route('admin.videos.index', ['locale' => app()->getLocale()]) }}"
                            class="rounded-lg border border-gray-300 dark:border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            Cancel
                        </a>
                    @endif
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ $video ? 'Save Changes' : 'Add Video' }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
