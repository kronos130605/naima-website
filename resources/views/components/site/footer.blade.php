<footer class="bg-white/80 backdrop-blur-md border-t border-blue-100">
    <div class="mx-auto max-w-6xl px-4 py-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-slate-600">
                {{ __('site.footer.copyright', ['year' => date('Y'), 'brand' => ($brand['name'] ?? 'FrenchBoost')]) }}
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">{{ __('site.footer.privacy') }}</a>
                <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">{{ __('site.footer.terms') }}</a>
                <div class="flex items-center gap-3">
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">📘</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">🐦</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors">📷</a>
                </div>
            </div>
        </div>
    </div>
</footer>
