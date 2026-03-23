<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $worksheet ? __('admin.worksheets.edit_prefix') . ' ' . $worksheet->title_en : __('admin.worksheets.new_worksheet') }}
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
                action="{{ $worksheet
                    ? route('admin.worksheets.update', ['locale' => app()->getLocale(), 'worksheet' => $worksheet])
                    : route('admin.worksheets.store', ['locale' => app()->getLocale()]) }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf
                @if($worksheet) @method('PUT') @endif

                {{-- Titles & Descriptions --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('admin.worksheets.section_titles') }}</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.title_en') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en', $worksheet?->title_en) }}" required placeholder="{{ __('admin.worksheets.placeholder_title_en') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.title_fr') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="title_fr" value="{{ old('title_fr', $worksheet?->title_fr) }}" required placeholder="{{ __('admin.worksheets.placeholder_title_fr') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.description_en') }}</label>
                            <textarea name="description_en" rows="3" placeholder="{{ __('admin.worksheets.placeholder_description') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_en', $worksheet?->description_en) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.description_fr') }}</label>
                            <textarea name="description_fr" rows="3" placeholder="{{ __('admin.worksheets.placeholder_description_fr') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_fr', $worksheet?->description_fr) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Classification --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('admin.worksheets.section_classification') }}</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.level') }} <span class="text-red-500">*</span></label>
                            <select name="level" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach(config('frenchboost.levels') as $key => $label)
                                    <option value="{{ $key }}" {{ old('level', $worksheet?->level) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.sort_order') }}</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $worksheet?->sort_order ?? 0) }}" min="0"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.topic_en') }}</label>
                            <input type="text" name="topic_en" value="{{ old('topic_en', $worksheet?->topic_en) }}" list="topic-en-list" placeholder="{{ __('admin.worksheets.placeholder_topic_en') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <datalist id="topic-en-list">
                                @foreach(config('frenchboost.topics_en') as $topic)
                                    <option>{{ $topic }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.worksheets.topic_fr') }}</label>
                            <input type="text" name="topic_fr" value="{{ old('topic_fr', $worksheet?->topic_fr) }}" list="topic-fr-list" placeholder="{{ __('admin.worksheets.placeholder_topic_fr') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <datalist id="topic-fr-list">
                                @foreach(config('frenchboost.topics_fr') as $topic)
                                    <option>{{ $topic }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                {{-- Files --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('admin.worksheets.section_files') }}</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.worksheets.preview_image') }}</label>
                        @if($worksheet?->preview_image)
                            <div class="mb-3 flex items-center gap-3">
                                <img src="{{ Storage::url($worksheet->preview_image) }}" class="h-20 rounded-lg border border-gray-200 dark:border-gray-700 object-cover" alt="">
                                <p class="text-xs text-gray-400">{{ __('admin.worksheets.preview_image_current') }}</p>
                            </div>
                        @endif
                        <input type="file" name="preview_image" accept="image/*"
                            class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-950/30 dark:file:text-blue-300 hover:file:bg-blue-100 transition-colors">
                        <p class="mt-1 text-xs text-gray-400">{{ __('admin.worksheets.preview_image_help') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.worksheets.pdf_file') }}</label>
                        @if($worksheet?->file_path)
                            <p class="mb-3 flex items-center gap-2 text-sm text-green-600 dark:text-green-400">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ __('admin.worksheets.pdf_file_current') }}
                            </p>
                        @endif
                        <input type="file" name="file_path" accept=".pdf"
                            class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-950/30 dark:file:text-blue-300 hover:file:bg-blue-100 transition-colors">
                        <p class="mt-1 text-xs text-gray-400">{{ __('admin.worksheets.pdf_file_help') }}</p>
                    </div>
                </div>

                {{-- Settings --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" id="is_published" value="1"
                            {{ old('is_published', $worksheet?->is_published ?? false) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_published" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.worksheets.is_published') }}
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between gap-4 pt-2 pb-8">
                    @if(request()->header('HX-Request'))
                        <button type="button" onclick="window.dispatchEvent(new Event('close-admin-modal'))"
                            class="rounded-lg border border-gray-300 dark:border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            {{ __('admin.common.cancel') }}
                        </button>
                    @else
                        <a href="{{ route('admin.worksheets.index', ['locale' => app()->getLocale()]) }}"
                            class="rounded-lg border border-gray-300 dark:border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            {{ __('admin.common.cancel') }}
                        </a>
                    @endif
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ $worksheet ? __('admin.common.save') : __('admin.worksheets.new_worksheet') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
