<section id="contact" class="bg-gradient-to-br from-yellow-100 via-blue-50 to-purple-100 py-20 relative overflow-hidden dark:from-slate-950 dark:to-slate-900">
    <div class="absolute top-10 right-10 w-80 h-80 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-72 h-72 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    
    <div class="mx-auto max-w-4xl px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
                {{ $contact['title'] }}
            </h2>
            <p class="text-xl text-slate-700 font-medium dark:text-slate-200">
                {{ __('site.contact.subtitle') }}
            </p>
        </div>
        <div class="bg-white rounded-[3rem] shadow-2xl p-10 border-8 border-blue-300 overflow-hidden hover:shadow-purple-500/40 transition-all dark:bg-slate-900 dark:border-purple-400">
            <div class="grid gap-10 md:grid-cols-2">
                <div class="space-y-8">
                    <div class="flex items-center gap-5 bg-blue-100 rounded-2xl p-5 border-4 border-blue-300 shadow-lg hover:scale-105 transition-all dark:bg-blue-900/30 dark:border-blue-500">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-4xl shadow-lg">📧</div>
                        <div>
                            <p class="font-extrabold text-blue-900 text-lg dark:text-blue-200">{{ __('site.contact.email_label') }}</p>
                            <p class="text-blue-700 font-medium dark:text-blue-300">{{ $contact['email'] ?? 'contact@frenchboost.com' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-5 bg-purple-100 rounded-2xl p-5 border-4 border-purple-300 shadow-lg hover:scale-105 transition-all dark:bg-purple-900/30 dark:border-purple-500">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-4xl shadow-lg">📱</div>
                        <div>
                            <p class="font-extrabold text-purple-900 text-lg dark:text-purple-200">{{ __('site.contact.phone_label') }}</p>
                            <p class="text-purple-700 font-medium dark:text-purple-300">{{ $contact['phone'] ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <h3 class="font-extrabold text-2xl text-blue-600 dark:text-blue-400">{{ __('site.contact.form_title') }}</h3>
                    <form class="space-y-5">
                        <input type="text" placeholder="{{ __('site.contact.form_name_placeholder') }}" class="w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400">
                        <input type="email" placeholder="{{ __('site.contact.form_email_placeholder') }}" class="w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400">
                        <textarea placeholder="{{ __('site.contact.form_message_placeholder') }}" rows="4" class="w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 resize-none transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400"></textarea>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold px-8 py-4 rounded-full hover:shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white text-lg">
                            🚀 {{ __('site.contact.form_submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
