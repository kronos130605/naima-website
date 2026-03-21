<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <a
            href="{{ route('site.home', ['locale' => (request()->route('locale') ?? app()->getLocale())]) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:text-blue-300 dark:hover:text-blue-200 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950"
        >
            <span aria-hidden="true">←</span>
            <span>{{ __('Back to home') }}</span>
        </a>
    </div>

    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">{{ __('Welcome back') }}</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ __('Sign in to continue') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false }">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <x-text-input
                    id="password"
                    class="block w-full pr-12"
                    ::type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    minlength="8"
                    autocomplete="current-password"
                />
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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-blue-200 text-blue-600 shadow-sm focus:ring-blue-500/30 dark:border-slate-800 dark:bg-slate-950" name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-slate-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:text-blue-300 dark:hover:text-blue-200 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
