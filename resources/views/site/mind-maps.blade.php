<x-site-layout :title="__('site.mind_maps.page_title') . ' — FrenchBoost'" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Page hero --}}
    <section class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                🗺 {{ __('site.mind_maps.badge') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ __('site.mind_maps.title') }}
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-xl mx-auto">
                {{ __('site.mind_maps.subtitle') }}
            </p>
        </div>
    </section>

    {{-- Filter + grid --}}
    <section
        class="py-12 px-4 bg-slate-50 dark:bg-slate-900 min-h-[60vh]"
        x-data="{ activeGroup: '{{ $current_group }}', modal: null, openModal(m){ this.modal=m; document.body.style.overflow='hidden'; }, closeModal(){ this.modal=null; document.body.style.overflow=''; } }"
        @keydown.escape.window="closeModal()"
    >
        <div class="mx-auto max-w-6xl">

            {{-- Level group filter tabs --}}
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($groups as $group)
                    @php
                        $url = $group['key'] === 'all'
                            ? route('site.mind-maps', ['locale' => $locale])
                            : route('site.mind-maps', ['locale' => $locale, 'group' => $group['key']]);
                    @endphp
                    <a
                        href="{{ $url }}"
                        hx-get="{{ $url }}"
                        hx-target="#mind-map-cards"
                        hx-swap="outerHTML"
                        hx-push-url="true"
                        hx-indicator="#cards-spinner"
                        @click="activeGroup = '{{ $group['key'] }}'"
                        :class="activeGroup === '{{ $group['key'] }}'
                            ? 'bg-blue-600 text-white border-blue-600 shadow-md'
                            : 'bg-white text-slate-600 border-slate-200 hover:border-blue-300 hover:text-blue-600 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700'"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition-all border"
                    >{{ $group['label_' . $lang] }}</a>
                @endforeach
            </div>

            {{-- Loading spinner (shown by HTMX via htmx-indicator) --}}
            <div id="cards-spinner" class="htmx-indicator flex justify-center py-12">
                <svg class="animate-spin h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"/>
                </svg>
            </div>

            {{-- Cards grid + pagination (partial, replaced by HTMX) --}}
            @include('site.partials.mind-map-cards')
        </div>

        {{-- Modal --}}
        <div
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
            x-show="modal !== null"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
        >
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" @click="closeModal()"></div>

            {{-- Modal panel --}}
            <div
                class="relative z-10 w-full max-w-2xl rounded-2xl bg-white shadow-2xl dark:bg-slate-900 overflow-hidden flex flex-col max-h-[90vh]"
                x-show="modal !== null"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.stop
            >
                {{-- Modal header --}}
                <div class="flex items-start justify-between gap-4 px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <div x-show="modal">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="rounded-full bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 dark:bg-blue-900/40 dark:text-blue-300" x-text="modal?.level"></span>
                            <span class="text-xs text-slate-400" x-text="modal?.['topic_{{ $lang }}']"></span>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-slate-100" x-text="modal?.['title_{{ $lang }}']"></h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5" x-text="modal?.['description_{{ $lang }}']"></p>
                    </div>
                    <button
                        type="button"
                        class="shrink-0 rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition-colors dark:hover:bg-slate-800"
                        @click="closeModal()"
                        aria-label="{{ __('site.mind_maps.close') }}"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Modal preview --}}
                <div class="overflow-y-auto flex-1">
                    <template x-if="modal?.preview">
                        <img :src="'/storage/' + modal.preview" :alt="modal?.['title_{{ $lang }}']" class="w-full h-auto">
                    </template>
                    <template x-if="!modal?.preview">
                        <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                            <div class="text-6xl mb-4">🗺</div>
                            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs">
                                {{ __('site.mind_maps.modal_preview_soon') }}
                            </p>
                        </div>
                    </template>
                </div>

                {{-- Modal footer --}}
                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                    <button
                        type="button"
                        class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                        @click="closeModal()"
                    >
                        {{ __('site.mind_maps.close') }}
                    </button>
                    <template x-if="modal?.file">
                        <a
                            :href="'/storage/' + modal.file"
                            target="_blank"
                            download
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            {{ __('site.mind_maps.download') }}
                        </a>
                    </template>
                    <template x-if="!modal?.file">
                        <span class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-4 py-2 text-sm text-slate-400 dark:bg-slate-700 dark:text-slate-500">
                            {{ __('site.mind_maps.coming_soon') }}
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </section>

</x-site-layout>
