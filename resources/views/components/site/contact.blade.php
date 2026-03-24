@php
    $designTheme = auth()->check()
        ? auth()->user()->getThemePreference()
        : \App\Models\SiteSetting::get('default_theme', 'new');
    $isNewDesign = $designTheme === 'new';
@endphp

<section id="contact" class="{{ $isNewDesign ? 'bg-gradient-to-br from-yellow-100 via-blue-50 to-purple-100 py-20 relative overflow-hidden dark:from-slate-950 dark:to-slate-900' : 'bg-gradient-to-br from-blue-50 to-indigo-50 py-20 dark:from-slate-950 dark:to-slate-900' }}">
    @if($isNewDesign)
        <div class="absolute top-10 right-10 w-80 h-80 bg-blue-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-72 h-72 bg-yellow-300 rounded-full opacity-20 blur-3xl"></div>
    @endif

    <div class="mx-auto max-w-4xl px-4 {{ $isNewDesign ? 'relative z-10' : '' }}">
        <div class="{{ $isNewDesign ? 'text-center mb-16' : 'text-center mb-12' }}">
            <h2 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);" @endif>
                {{ $contact['title'] }}
            </h2>
            <p class="{{ $isNewDesign ? 'text-xl text-slate-700 font-medium dark:text-slate-200' : 'text-lg text-slate-600 dark:text-slate-300' }}">
                {{ __('site.contact.subtitle') }}
            </p>
        </div>
        <div class="{{
            $isNewDesign
                ? 'bg-white rounded-[3rem] shadow-2xl p-10 border-8 border-blue-300 overflow-hidden hover:shadow-purple-500/40 transition-all dark:bg-slate-900 dark:border-purple-400'
                : 'bg-white rounded-3xl shadow-xl p-8 border border-blue-100 overflow-hidden hover:shadow-2xl transition-all focus-within:ring-2 focus-within:ring-blue-500/30 focus-within:ring-offset-2 focus-within:ring-offset-white dark:bg-slate-950/70 dark:border-slate-800 dark:focus-within:ring-blue-400/30 dark:focus-within:ring-offset-slate-950'
        }}">
            <div class="{{ $isNewDesign ? 'grid gap-10 md:grid-cols-2' : 'grid gap-8 md:grid-cols-2' }}">
                <div class="{{ $isNewDesign ? 'space-y-8' : 'space-y-6' }}">
                    <div class="{{
                        $isNewDesign
                            ? 'flex items-center gap-5 bg-blue-100 rounded-2xl p-5 border-4 border-blue-300 shadow-lg hover:scale-105 transition-all dark:bg-blue-900/30 dark:border-blue-500'
                            : 'flex items-center gap-4'
                    }}">
                        <div class="{{ $isNewDesign ? 'w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-4xl shadow-lg' : 'w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600' }}">📧</div>
                        <div>
                            <p class="{{ $isNewDesign ? 'font-extrabold text-blue-900 text-lg dark:text-blue-200' : 'font-semibold text-slate-900 dark:text-slate-100' }}">{{ __('site.contact.email_label') }}</p>
                            <p class="{{ $isNewDesign ? 'text-blue-700 font-medium dark:text-blue-300' : 'text-slate-600 dark:text-slate-300' }}">{{ $contact['email'] ?? 'contact@frenchboost.com' }}</p>
                        </div>
                    </div>
                    <div class="{{
                        $isNewDesign
                            ? 'flex items-center gap-5 bg-purple-100 rounded-2xl p-5 border-4 border-purple-300 shadow-lg hover:scale-105 transition-all dark:bg-purple-900/30 dark:border-purple-500'
                            : 'flex items-center gap-4'
                    }}">
                        <div class="{{ $isNewDesign ? 'w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-4xl shadow-lg' : 'w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600' }}">📱</div>
                        <div>
                            <p class="{{ $isNewDesign ? 'font-extrabold text-purple-900 text-lg dark:text-purple-200' : 'font-semibold text-slate-900 dark:text-slate-100' }}">{{ __('site.contact.phone_label') }}</p>
                            <p class="{{ $isNewDesign ? 'text-purple-700 font-medium dark:text-purple-300' : 'text-slate-600 dark:text-slate-300' }}">{{ $contact['phone'] ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                </div>
                <div class="{{ $isNewDesign ? 'space-y-6' : 'space-y-4' }}">
                    <h3 class="{{ $isNewDesign ? 'font-extrabold text-2xl text-blue-600 dark:text-blue-400' : 'font-semibold text-slate-900 dark:text-slate-100' }}">{{ __('site.contact.form_title') }}</h3>
                    <form class="{{ $isNewDesign ? 'space-y-5' : 'space-y-4' }}">
                        <input type="text" placeholder="{{ __('site.contact.form_name_placeholder') }}" class="{{ $isNewDesign ? 'w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">
                        <input type="email" placeholder="{{ __('site.contact.form_email_placeholder') }}" class="{{ $isNewDesign ? 'w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">
                        <textarea placeholder="{{ __('site.contact.form_message_placeholder') }}" rows="4" class="{{ $isNewDesign ? 'w-full px-5 py-4 rounded-2xl border-4 border-blue-300 bg-white font-medium focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-500/30 resize-none transition-all dark:border-purple-600 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-purple-400' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 resize-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}"></textarea>
                        <button type="submit" class="{{ $isNewDesign ? 'w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold px-8 py-4 rounded-full hover:shadow-2xl hover:shadow-purple-500/50 transition-all hover:scale-110 hover:-rotate-1 border-4 border-white text-lg' : 'w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl hover:shadow-lg transition-all hover:scale-105' }}">
                            @if($isNewDesign)
                                🚀
                            @endif
                            {{ __('site.contact.form_submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
