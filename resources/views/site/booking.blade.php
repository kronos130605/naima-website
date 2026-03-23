<x-site-layout :title="__('site.page_title.booking')" :brand="$brand" :cta="$cta" :locale="$locale" :locales="$locales">

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 py-16 px-4">
        <div class="mx-auto max-w-4xl text-center">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-sm font-semibold text-white mb-5">
                {{ __('site.booking.badge') }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ __('site.booking.title') }}
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-xl mx-auto">
                {{ __('site.booking.subtitle') }}
            </p>
        </div>
    </section>

    {{-- Form / Success --}}
    <section class="py-16 px-4 bg-slate-50 dark:bg-slate-900 min-h-[60vh]">
        <div class="mx-auto max-w-xl">

            @if(session('success'))
                {{-- Success state --}}
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 p-10 text-center">
                    <div class="text-6xl mb-5">🎉</div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-3">
                        {{ __('site.booking.success_title') }}
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-8">
                        {{ __('site.booking.success_body') }}
                    </p>
                    <a href="{{ route('site.home', ['locale' => $locale]) }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition-colors">
                        ← {{ __('site.booking.back_home') }}
                    </a>
                </div>
            @else
                {{-- Booking form --}}
                <div class="rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 p-8">

                    @if($errors->any())
                        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm dark:bg-red-950/30 dark:border-red-800 dark:text-red-400">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('site.booking.store', ['locale' => $locale]) }}" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('site.booking.name_label') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text" name="name" required
                                value="{{ old('name') }}"
                                placeholder="{{ __('site.booking.name_placeholder') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('site.booking.email_label') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email" name="email" required
                                value="{{ old('email') }}"
                                placeholder="{{ __('site.booking.email_placeholder') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                            >
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                    {{ __('site.booking.phone_label') }}
                                </label>
                                <input
                                    type="tel" name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="{{ __('site.booking.phone_placeholder') }}"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                    {{ __('site.booking.level_label') }}
                                </label>
                                <input
                                    type="text" name="student_level"
                                    value="{{ old('student_level') }}"
                                    placeholder="{{ __('site.booking.level_placeholder') }}"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ __('site.booking.message_label') }}
                            </label>
                            <textarea
                                name="message" rows="4"
                                placeholder="{{ __('site.booking.message_placeholder') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500 resize-none"
                            >{{ old('message') }}</textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 active:scale-[0.98] transition-all"
                        >
                            {{ __('site.booking.submit') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </section>

</x-site-layout>
