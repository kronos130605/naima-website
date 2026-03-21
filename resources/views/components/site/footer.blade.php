<footer class="bg-white/80 backdrop-blur-md border-t border-blue-100 dark:bg-slate-950/80 dark:border-slate-800">
    <div class="mx-auto max-w-6xl px-4 py-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-slate-600 dark:text-slate-300">
                {{ __('site.footer.copyright', ['year' => date('Y'), 'brand' => ($brand['name'] ?? 'FrenchBoost')]) }}
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors dark:text-slate-300 dark:hover:text-blue-400">{{ __('site.footer.privacy') }}</a>
                <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors dark:text-slate-300 dark:hover:text-blue-400">{{ __('site.footer.terms') }}</a>
                <div class="flex items-center gap-3">
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">📘</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">🐦</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">📷</a>
                </div>
            </div>
        </div>
    </div>
</footer>
