<x-site-layout :title="__('site.page_title.mind_maps')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

    {{-- Page hero --}}
    <section class="bg-gradient-to-br from-blue-400 via-indigo-400 to-purple-500 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-10 right-10 w-64 h-64 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-72 h-72 bg-pink-300 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="mx-auto max-w-4xl text-center relative z-10">
            <div class="inline-flex items-center gap-3 rounded-full bg-white px-6 py-3 text-lg font-black text-indigo-600 mb-6 shadow-xl border-4 border-yellow-300">
                <span class="text-3xl">🗺</span> {{ __('site.mind_maps.badge') }}
            </div>
            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-6" style="text-shadow: 3px 3px 0px rgba(0,0,0,0.2);">
                {{ __('site.mind_maps.title') }}
            </h1>
            <p class="text-xl text-white font-bold max-w-xl mx-auto drop-shadow-lg">
                {{ __('site.mind_maps.subtitle') }}
            </p>
        </div>
    </section>

    {{-- Filter + grid --}}
    <section
        class="py-16 px-4 bg-gradient-to-br from-blue-50 via-purple-50 to-yellow-50 dark:bg-slate-900 min-h-[60vh] relative"
        x-data="{ activeGroup: '{{ $current_group }}', modal: null, openModal(m){ this.modal=m; document.body.style.overflow='hidden'; }, closeModal(){ this.modal=null; document.body.style.overflow=''; } }"
        @keydown.escape.window="closeModal()"
    >
        <div class="absolute top-20 left-20 w-48 h-48 bg-indigo-200 rounded-full opacity-20 blur-3xl"></div>
        <div class="mx-auto max-w-6xl">

            {{-- Level group filter tabs --}}
            <div class="flex flex-wrap gap-3 mb-12">
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
                            ? 'bg-indigo-500 text-white border-4 border-white shadow-xl scale-110'
                            : 'bg-white text-indigo-600 border-4 border-indigo-300 hover:bg-indigo-50 dark:bg-slate-800 dark:text-indigo-400 dark:border-indigo-500'"
                        class="rounded-full px-6 py-3 text-base font-black transition-all hover:scale-105 shadow-lg"
                    >{{ $group['label_' . $lang] }}</a>
                @endforeach
            </div>

            {{-- Loading spinner (shown by HTMX via htmx-indicator) --}}
            <div id="cards-spinner" class="htmx-indicator flex justify-center py-12">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow-2xl border-4 border-white animate-bounce">
                    <svg class="animate-spin h-8 w-8 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"/>
                    </svg>
                </div>
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
                class="relative z-10 w-full max-w-2xl rounded-[3rem] bg-white shadow-2xl border-8 border-indigo-300 dark:bg-slate-900 dark:border-purple-400 overflow-hidden flex flex-col max-h-[90vh]"
                x-show="modal !== null"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
            >
                {{-- Modal header --}}
                <div class="flex items-start justify-between gap-4 px-8 py-6 border-b-4 border-indigo-200 dark:border-purple-600">
                    <div x-show="modal">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="rounded-full bg-indigo-400 text-white text-sm font-black px-4 py-1 shadow-lg border-2 border-white" x-text="modal?.level"></span>
                            <span class="text-sm text-indigo-600 font-bold dark:text-indigo-400" x-text="modal?.['topic_{{ $lang }}']" ></span>
                        </div>
                        <h2 class="text-2xl font-black text-indigo-600 dark:text-indigo-400" x-text="modal?.['title_{{ $lang }}']" ></h2>
                        <p class="text-base text-slate-600 dark:text-slate-300 mt-2 font-medium" x-text="modal?.['description_{{ $lang }}']" ></p>
                    </div>
                    <button
                        type="button"
                        class="shrink-0 rounded-2xl p-3 bg-yellow-300 text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 hover:rotate-12 shadow-lg border-4 border-white"
                        @click="closeModal()"
                        aria-label="{{ __('site.mind_maps.close') }}"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
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
                <div class="flex items-center justify-end gap-4 px-8 py-6 border-t-4 border-indigo-200 dark:border-purple-600">
                    <button
                        type="button"
                        class="rounded-full border-4 border-indigo-300 bg-white px-6 py-3 text-base font-bold text-indigo-600 hover:bg-indigo-50 transition-all hover:scale-105 shadow-lg dark:bg-slate-800 dark:text-indigo-400 dark:border-indigo-500"
                        @click="closeModal()"
                    >
                        {{ __('site.mind_maps.close') }}
                    </button>
                    <template x-if="modal?.file">
                        <a
                            :href="'/storage/' + modal.file"
                            target="_blank"
                            download
                            class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-3 text-base font-bold text-white hover:shadow-purple-500/50 transition-all hover:scale-110 shadow-xl border-4 border-white"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            {{ __('site.mind_maps.download') }}
                        </a>
                    </template>
                    <template x-if="!modal?.file">
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-6 py-3 text-base font-bold text-slate-500 dark:bg-slate-700 dark:text-slate-400">
                            {{ __('site.mind_maps.coming_soon') }}
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </section>

</x-site-layout>
