<section id="testimonials" class="bg-gradient-to-br from-yellow-100 via-purple-50 to-blue-100 py-20 relative overflow-hidden dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    <div class="absolute top-20 left-10 w-64 h-64 bg-yellow-300 rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute bottom-10 right-20 w-80 h-80 bg-purple-300 rounded-full opacity-10 blur-3xl"></div>

    <div class="mx-auto max-w-6xl px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-purple-600 mb-4 dark:text-purple-400" style="text-shadow: 2px 2px 0px rgba(59, 130, 246, 0.3);">
                {{ $testimonials['title'] }}
            </h2>
            <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium dark:text-slate-200">
                {{ __('site.testimonials.subtitle') }}
            </p>

            <div class="mt-8">
                <a
                    href="{{ route('site.testimonials', ['locale' => app()->getLocale()]) }}#submit"
                    class="inline-flex items-center justify-center rounded-2xl border-4 border-white bg-yellow-300 px-6 py-3 text-base font-black text-blue-900 hover:bg-yellow-400 transition-all hover:scale-110 shadow-lg"
                >
                    {{ __('Leave a testimonial') }}
                </a>
            </div>
        </div>

        {{-- Scrollable testimonials container --}}
        <div class="relative mb-12">
            <div class="overflow-y-auto max-h-[600px] pr-2 scrollbar-thin scrollbar-thumb-purple-400 scrollbar-track-purple-100 dark:scrollbar-thumb-purple-600 dark:scrollbar-track-slate-800">
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach(($testimonials['items'] ?? []) as $t)
                        <div class="relative bg-white rounded-[2rem] shadow-2xl border-6 border-yellow-300 p-8 hover:shadow-purple-500/40 transition-all hover:-translate-y-3 hover:rotate-1 dark:bg-slate-900 dark:border-purple-400">
                            <div class="flex text-yellow-400 text-2xl mb-4">
                                @for($i = 0; $i < (int)($t['rating'] ?? 5); $i++)
                                    ★
                                @endfor
                            </div>
                            <blockquote class="text-slate-700 leading-relaxed font-medium text-base dark:text-slate-100 mb-6">
                                "{{ $t['body'] }}"
                            </blockquote>
                            <div class="flex items-center gap-4 border-t-4 border-yellow-200 pt-4 dark:border-purple-600">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-lg font-black shadow-lg">
                                    {{ strtoupper(mb_substr($t['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-blue-600 text-base dark:text-blue-400">{{ $t['name'] }}</p>
                                    @if(!empty($t['role']))
                                        <p class="text-sm text-purple-600 font-medium dark:text-purple-400">{{ $t['role'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Add testimonial form for authenticated users --}}
        @auth
            <div class="max-w-2xl mx-auto bg-white rounded-[2rem] shadow-2xl border-6 border-blue-300 p-8 dark:bg-slate-900 dark:border-blue-600">
                <h3 class="text-2xl font-extrabold text-blue-600 mb-6 dark:text-blue-400">
                    {{ __('Share Your Experience') }}
                </h3>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-4 border-green-300 rounded-2xl text-green-800 font-bold dark:bg-green-900/30 dark:border-green-600 dark:text-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('site.testimonials.store', ['locale' => app()->getLocale()]) }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Your Name') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required maxlength="255"
                            class="w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Your Role (Optional)') }}</label>
                        <input type="text" id="role" name="role" value="{{ old('role') }}" maxlength="255" placeholder="e.g., Parent of a Grade 5 student"
                            class="w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100">
                        @error('role')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-bold text-slate-700 mb-2 dark:text-slate-200">{{ __('Rating') }}</label>
                        <select id="rating" name="rating" required
                            class="w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100">
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
                            class="w-full px-4 py-3 rounded-xl border-4 border-blue-200 focus:border-blue-400 focus:ring-4 focus:ring-blue-200/50 transition-all dark:bg-slate-800 dark:border-blue-600 dark:text-slate-100">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-black text-lg rounded-2xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all border-4 border-white">
                        {{ __('Submit Testimonial') }}
                    </button>

                    <p class="text-sm text-slate-600 text-center dark:text-slate-400">
                        {{ __('Your testimonial will be reviewed before being published.') }}
                    </p>
                </form>
            </div>
        @endauth
    </div>
</section>
