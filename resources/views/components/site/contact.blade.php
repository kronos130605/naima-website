<section id="contact" class="bg-gradient-to-br from-blue-50 to-indigo-50 py-20 dark:from-slate-950 dark:to-slate-900">
    <div class="mx-auto max-w-4xl px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                {{ $contact['title'] }}
            </h2>
            <p class="text-lg text-slate-600 dark:text-slate-300">
                {{ __('site.contact.subtitle') }}
            </p>
        </div>
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-blue-100 overflow-hidden hover:shadow-2xl transition-all focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950">
            <div class="grid gap-8 md:grid-cols-2">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">📧</div>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ __('site.contact.email_label') }}</p>
                            <p class="text-slate-600 dark:text-slate-300">{{ $contact['email'] ?? 'contact@frenchboost.com' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">📱</div>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ __('site.contact.phone_label') }}</p>
                            <p class="text-slate-600 dark:text-slate-300">{{ $contact['phone'] ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="font-semibold text-slate-900 dark:text-slate-100">{{ __('site.contact.form_title') }}</h3>
                    <form class="space-y-4">
                        <input type="text" placeholder="{{ __('site.contact.form_name_placeholder') }}" class="w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                        <input type="email" placeholder="{{ __('site.contact.form_email_placeholder') }}" class="w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20">
                        <textarea placeholder="{{ __('site.contact.form_message_placeholder') }}" rows="4" class="w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 resize-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20"></textarea>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl hover:shadow-lg transition-all hover:scale-105">
                            {{ __('site.contact.form_submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
