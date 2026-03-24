<x-site-layout :title="__('site.page_title.testimonials')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    @php
        $designTheme = auth()->check()
            ? auth()->user()->getThemePreference()
            : \App\Models\SiteSetting::get('default_theme', 'new');
        $isNewDesign = $designTheme === 'new';
    @endphp

    <section id="testimonials" class="{{
        $isNewDesign
            ? 'bg-gradient-to-br from-yellow-100 via-purple-50 to-blue-100 py-20 relative overflow-hidden dark:from-slate-950 dark:via-slate-900 dark:to-slate-950'
            : 'bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950'
    }}">
        @if($isNewDesign)
            <div class="absolute top-20 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-10 blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-80 h-80 bg-purple-300 rounded-full opacity-10 blur-3xl"></div>
        @endif

        <div class="mx-auto max-w-6xl px-4 {{ $isNewDesign ? 'relative z-10' : '' }}">
            <div class="{{ $isNewDesign ? 'text-center mb-16' : 'text-center mb-12' }}">
                <h1 class="{{ $isNewDesign ? 'text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400' : 'text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4' }}" @if($isNewDesign) style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);" @endif>
                    {{ __('site.nav.testimonials') }}
                </h1>
                <p class="{{ $isNewDesign ? 'text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200' : 'text-lg text-slate-600 max-w-2xl mx-auto dark:text-slate-300' }}">
                    {{ __('site.testimonials.subtitle') }}
                </p>
            </div>

            <div class="{{ $isNewDesign ? 'grid gap-8 md:grid-cols-2 lg:grid-cols-3 mb-16' : 'grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-12' }}">
                @forelse($posts as $post)
                    <div class="{{
                        $isNewDesign
                            ? 'relative bg-white rounded-[2rem] shadow-2xl border-6 border-yellow-300 p-8 dark:bg-slate-900 dark:border-purple-400'
                            : 'relative bg-white rounded-2xl shadow-lg border border-blue-100 p-8 hover:shadow-xl transition-all hover:-translate-y-0.5 dark:bg-slate-950/70 dark:border-slate-800'
                    }}">
                        <div class="{{ $isNewDesign ? 'flex text-yellow-400 text-2xl mb-4' : 'flex text-yellow-400 text-lg mb-4' }}">
                            @for($i = 0; $i < (int)($post->rating ?? 5); $i++)
                                ★
                            @endfor
                        </div>
                        <blockquote class="{{ $isNewDesign ? 'text-slate-700 leading-relaxed font-medium text-base dark:text-slate-100 mb-6' : 'text-slate-700 leading-relaxed italic dark:text-slate-200 mb-6' }}">
                            "{{ $post->body }}"
                        </blockquote>
                        <div class="{{ $isNewDesign ? 'flex items-center gap-4 border-t-4 border-yellow-200 pt-4 dark:border-purple-600' : 'flex items-center gap-3 border-t border-blue-50 pt-4 dark:border-slate-800' }}">
                            <div class="{{ $isNewDesign ? 'w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-lg font-black shadow-lg' : 'w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-indigo-400 flex items-center justify-center text-white text-sm font-bold' }}">
                                {{ strtoupper(mb_substr($post->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="{{ $isNewDesign ? 'font-bold text-blue-600 text-base dark:text-blue-400' : 'font-semibold text-slate-900 text-sm dark:text-slate-100' }}">{{ $post->name }}</p>
                                @if(!empty($post->role))
                                    <p class="{{ $isNewDesign ? 'text-sm text-purple-600 font-medium dark:text-purple-400' : 'text-xs text-slate-500 dark:text-slate-400' }}">{{ $post->role }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-600 dark:text-slate-300">{{ __('No testimonials yet.') }}</p>
                    </div>
                @endforelse
            </div>

            <div id="submit" class="scroll-mt-24">
                @auth
                    <div class="{{
                        $isNewDesign
                            ? 'max-w-2xl mx-auto bg-white rounded-[2rem] shadow-2xl border-6 border-blue-300 p-8 dark:bg-slate-900 dark:border-blue-600'
                            : 'max-w-2xl mx-auto bg-white rounded-3xl shadow-xl border border-blue-100 p-8 dark:bg-slate-950/70 dark:border-slate-800'
                    }}">
                        <h2 class="{{ $isNewDesign ? 'text-2xl font-extrabold text-blue-600 mb-6 dark:text-blue-400' : 'text-xl font-semibold text-slate-900 mb-6 dark:text-slate-100' }}">
                            {{ __('Share Your Experience') }}
                        </h2>

                        @if(session('success'))
                            <div class="{{ $isNewDesign ? 'mb-6 p-4 bg-green-100 border-4 border-green-300 rounded-2xl text-green-800 font-bold dark:bg-green-900/30 dark:border-green-600 dark:text-green-300' : 'mb-6 p-4 bg-green-100 border border-green-200 rounded-xl text-green-800 dark:bg-green-900/30 dark:border-green-700 dark:text-green-300' }}">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('site.testimonials.store', ['locale' => $locale]) }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Your Name') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required maxlength="255"
                                    class="{{ $isNewDesign ? 'w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Your Role (Optional)') }}</label>
                                <input type="text" id="role" name="role" value="{{ old('role') }}" maxlength="255" placeholder="e.g., Parent of a Grade 5 student"
                                    class="{{ $isNewDesign ? 'w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Rating') }}</label>
                                <select id="rating" name="rating" required
                                    class="{{ $isNewDesign ? 'w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">
                                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 stars)</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 stars)</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 stars)</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 stars)</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 star)</option>
                                </select>
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="body" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Your Testimonial') }}</label>
                                <textarea id="body" name="body" required maxlength="1000" rows="4"
                                    class="{{ $isNewDesign ? 'w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100' : 'w-full px-4 py-3 rounded-xl border border-blue-200 bg-white focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-100 dark:focus:border-blue-400 dark:focus:ring-blue-400/20' }}">{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="{{ $isNewDesign ? 'w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-black text-lg rounded-2xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all border-4 border-white' : 'w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold px-6 py-3 rounded-xl hover:shadow-lg transition-all hover:scale-105' }}">
                                {{ __('Submit Testimonial') }}
                            </button>

                            <p class="text-sm text-slate-600 text-center dark:text-slate-400">
                                {{ __('Your testimonial will be reviewed before being published.') }}
                            </p>
                        </form>
                    </div>
                @else
                    <div class="{{
                        $isNewDesign
                            ? 'max-w-2xl mx-auto bg-white rounded-[2rem] shadow-2xl border-6 border-blue-300 p-8 text-center dark:bg-slate-900 dark:border-blue-600'
                            : 'max-w-2xl mx-auto bg-white rounded-3xl shadow-xl border border-blue-100 p-8 text-center dark:bg-slate-950/70 dark:border-slate-800'
                    }}">
                        <h2 class="{{ $isNewDesign ? 'text-2xl font-extrabold text-blue-600 mb-2 dark:text-blue-400' : 'text-xl font-semibold text-slate-900 mb-2 dark:text-slate-100' }}">{{ __('Share Your Experience') }}</h2>
                        <p class="{{ $isNewDesign ? 'text-slate-700 dark:text-slate-200 mb-6' : 'text-slate-600 dark:text-slate-300 mb-6' }}">{{ __('Log in to submit a testimonial.') }}</p>
                        <a href="{{ route('login', ['locale' => $locale]) }}" class="{{ $isNewDesign ? 'inline-flex items-center justify-center rounded-2xl border-4 border-white bg-yellow-300 px-5 py-2.5 text-base font-black text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 shadow-lg' : 'inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all hover:scale-105' }}">
                            {{ __('Log in') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

</x-site-layout>
