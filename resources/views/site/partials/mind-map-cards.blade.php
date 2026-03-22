@php $lang = $locale === 'fr' ? 'fr' : 'en'; @endphp

<div id="mind-map-cards">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($maps as $map)
            @php
                $d = [
                    'level'          => $map->level,
                    'topic_en'       => $map->topic_en,
                    'topic_fr'       => $map->topic_fr,
                    'title_en'       => $map->title_en,
                    'title_fr'       => $map->title_fr,
                    'description_en' => $map->description_en,
                    'description_fr' => $map->description_fr,
                    'preview'        => $map->preview_image,
                    'file'           => $map->file_path,
                ];
            @endphp
            <div class="group relative flex flex-col bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all overflow-hidden dark:bg-slate-800 dark:border-slate-700">
                <div
                    class="aspect-[4/3] bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center cursor-pointer relative"
                    @click="openModal({{ Js::from($d) }})"
                >
                    @if($map->preview_image)
                        <img src="{{ Storage::url($map->preview_image) }}" alt="{{ $map->{'title_'.$lang} }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-center p-6">
                            <div class="text-5xl mb-2">🗺</div>
                            <p class="text-xs text-slate-400 dark:text-slate-500">{{ __('site.mind_maps.preview_soon') }}</p>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/10 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <span class="rounded-full bg-white/90 px-3 py-1.5 text-xs font-semibold text-blue-700 shadow">{{ __('site.mind_maps.view') }}</span>
                    </div>
                </div>
                <div class="flex flex-col flex-1 p-4 gap-2">
                    <div class="flex items-center gap-2">
                        <span class="rounded-full bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 dark:bg-blue-900/40 dark:text-blue-300">{{ $map->level }}</span>
                        <span class="rounded-full bg-slate-100 text-slate-500 text-xs px-2 py-0.5 dark:bg-slate-700 dark:text-slate-400">{{ $map->{'topic_'.$lang} }}</span>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-snug">{{ $map->{'title_'.$lang} }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 flex-1 leading-relaxed">{{ $map->{'description_'.$lang} }}</p>
                    <div class="flex gap-2 mt-1">
                        <button
                            type="button"
                            class="flex-1 rounded-lg border border-blue-200 py-1.5 text-xs font-medium text-blue-700 hover:bg-blue-50 transition-colors dark:border-blue-800 dark:text-blue-400 dark:hover:bg-blue-950/30"
                            @click="openModal({{ Js::from($d) }})"
                        >{{ __('site.mind_maps.view') }}</button>
                        @if($map->file_path)
                            <a href="{{ Storage::url($map->file_path) }}" target="_blank" download
                               class="flex-1 rounded-lg bg-blue-600 py-1.5 text-center text-xs font-medium text-white hover:bg-blue-700 transition-colors">
                                {{ __('site.mind_maps.download') }}
                            </a>
                        @else
                            <span class="flex-1 rounded-lg bg-slate-100 py-1.5 text-center text-xs text-slate-400 dark:bg-slate-700 dark:text-slate-500">
                                {{ __('site.mind_maps.coming_soon') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center text-slate-400">
                <div class="text-5xl mb-3">🔍</div>
                <p class="text-sm">{{ __('site.mind_maps.empty') }}</p>
            </div>
        @endforelse
    </div>

    @if($maps->hasPages())
        <div class="mt-10 flex justify-center">{{ $maps->links() }}</div>
    @endif
</div>
