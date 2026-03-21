<x-guest-layout>
    <div class="mb-6">
        <a
            href="{{ route('site.home', ['locale' => (request()->route('locale') ?? app()->getLocale())]) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:text-blue-300 dark:hover:text-blue-200 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950"
        >
            <span aria-hidden="true">←</span>
            <span>{{ __('Back to home') }}</span>
        </a>
    </div>

    <div class="mb-6 text-sm text-slate-600 dark:text-slate-300">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm', ['locale' => (request()->route('locale') ?? app()->getLocale())]) }}" x-data="{ showPassword: false }">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-12" ::type="showPassword ? 'text' : 'password'" name="password" required minlength="8" autocomplete="current-password" />
                <button
                    type="button"
                    class="absolute inset-y-0 right-2 my-2 inline-flex items-center justify-center rounded-lg px-2 text-slate-500 hover:bg-blue-50 hover:text-slate-700 transition-colors dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                    @click="showPassword = !showPassword"
                    :aria-pressed="showPassword.toString()"
                    aria-label="Toggle password visibility"
                >
                    <span x-show="!showPassword" aria-hidden="true">👁️</span>
                    <span x-show="showPassword" aria-hidden="true">🙈</span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
