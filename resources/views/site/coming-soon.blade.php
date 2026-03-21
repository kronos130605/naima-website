<x-site-layout :title="__('site.coming_soon.title') . ' — FrenchBoost'" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    <section class="min-h-[70vh] flex flex-col items-center justify-center px-4 py-20 text-center">
        <div class="text-6xl mb-6">
            @if($page === 'videos') 🎬
            @elseif($page === 'worksheets') 📄
            @else 🚧
            @endif
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 mb-3">
            {{ __('site.coming_soon.title') }}
        </h1>
        <p class="text-slate-500 dark:text-slate-400 max-w-sm mb-8">
            {{ __('site.coming_soon.subtitle') }}
        </p>
        <a
            href="{{ route('site.home', ['locale' => $locale]) }}"
            class="inline-flex items-center gap-2 rounded-lg border border-blue-200 px-5 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 transition-colors dark:border-blue-700 dark:text-blue-400 dark:hover:bg-blue-950/30"
        >
            ← {{ __('site.coming_soon.back_home') }}
        </a>
    </section>

</x-site-layout>
