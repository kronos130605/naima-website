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

    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">{{ __('Create your account') }}</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ __('Start your FrenchBoost journey') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ showPassword: false, showPasswordConfirm: false }">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
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
                    autocomplete="new-password"
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative mt-1">
                <x-text-input
                    id="password_confirmation"
                    class="block w-full pr-12"
                    ::type="showPasswordConfirm ? 'text' : 'password'"
                    name="password_confirmation"
                    required
                    minlength="8"
                    autocomplete="new-password"
                />
                <button
                    type="button"
                    class="absolute inset-y-0 right-2 my-2 inline-flex items-center justify-center rounded-lg px-2 text-slate-500 hover:bg-blue-50 hover:text-slate-700 transition-colors dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                    @click="showPasswordConfirm = !showPasswordConfirm"
                    :aria-pressed="showPasswordConfirm.toString()"
                    aria-label="Toggle password visibility"
                >
                    <span x-show="!showPasswordConfirm" aria-hidden="true">👁️</span>
                    <span x-show="showPasswordConfirm" aria-hidden="true">🙈</span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:text-blue-300 dark:hover:text-blue-200 dark:focus-visible:ring-blue-400/40 dark:focus-visible:ring-offset-slate-950" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
