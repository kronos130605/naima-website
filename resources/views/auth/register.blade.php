<x-guest-layout>

    {{-- Header --}}
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-950/50 dark:text-blue-300 mb-4">
            ✨ {{ __('Create account') }}
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">{{ __('Set up your account') }}</h1>
        <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">{{ __('Admin access for FrenchBoost') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ showPassword: false, showPasswordConfirm: false }" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Full name')" />
            <x-text-input
                id="name" name="name" type="text"
                class="block mt-1.5 w-full"
                :value="old('name')"
                required autofocus autocomplete="name"
                placeholder="Naima"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email" name="email" type="email"
                class="block mt-1.5 w-full"
                :value="old('email')"
                required autocomplete="username"
                placeholder="you@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-1.5" />
            <div class="relative">
                <x-text-input
                    id="password" name="password"
                    ::type="showPassword ? 'text' : 'password'"
                    class="block w-full pr-11"
                    required minlength="8"
                    autocomplete="new-password"
                    placeholder="Min. 8 characters"
                />
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center justify-center w-11 text-slate-400 hover:text-slate-600 transition-colors dark:hover:text-slate-300"
                    @click="showPassword = !showPassword"
                    :aria-pressed="showPassword.toString()"
                    aria-label="Toggle password visibility"
                >
                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm password')" class="mb-1.5" />
            <div class="relative">
                <x-text-input
                    id="password_confirmation" name="password_confirmation"
                    ::type="showPasswordConfirm ? 'text' : 'password'"
                    class="block w-full pr-11"
                    required minlength="8"
                    autocomplete="new-password"
                    placeholder="Repeat password"
                />
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center justify-center w-11 text-slate-400 hover:text-slate-600 transition-colors dark:hover:text-slate-300"
                    @click="showPasswordConfirm = !showPasswordConfirm"
                    :aria-pressed="showPasswordConfirm.toString()"
                    aria-label="Toggle confirm password visibility"
                >
                    <svg x-show="!showPasswordConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-show="showPasswordConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        {{-- Submit --}}
        <x-primary-button class="w-full justify-center py-3 text-base mt-2">
            {{ __('Create account') }}
        </x-primary-button>

    </form>

    {{-- Already registered --}}
    <p class="mt-8 text-center text-sm text-slate-500 dark:text-slate-400">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors dark:text-blue-400 dark:hover:text-blue-300">
            {{ __('Sign in') }}
        </a>
    </p>

    {{-- Back to site --}}
    <p class="mt-3 text-center text-sm">
        <a
            href="{{ route('site.home', ['locale' => (request()->route('locale') ?? app()->getLocale())]) }}"
            class="text-slate-400 hover:text-slate-600 transition-colors dark:hover:text-slate-300"
        >← {{ __('Back to site') }}</a>
    </p>

</x-guest-layout>
