<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ __('admin.settings.title') }}</h2>

        @if(session('status') === 'profile-updated')
            <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                {{ __('admin.settings.profile_updated') }}
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                {{ __('admin.settings.password_updated') }}
            </div>
        @endif

        {{-- Profile Information --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('admin.settings.profile_title') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('admin.settings.profile_desc') }}</p>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update', ['locale' => app()->getLocale()]) }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.settings.label_name') }}</label>
                    <input id="name" name="name" type="text" required autocomplete="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($errors->get('name'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.settings.label_email') }}</label>
                    <input id="email" name="email" type="email" required autocomplete="username"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($errors->get('email'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('admin.settings.save_profile') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Default Theme Setting --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Default Site Theme') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Set the default theme for all new users and visitors.') }}</p>

            @if(session('success'))
                <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 dark:bg-green-950/30 dark:border-green-800 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.settings.default-theme', ['locale' => app()->getLocale()]) }}" class="space-y-4">
                @csrf

                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                id="theme-new" 
                                name="default_theme" 
                                type="radio" 
                                value="new" 
                                {{ ($defaultTheme ?? 'new') === 'new' ? 'checked' : '' }}
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="theme-new" class="font-medium text-gray-700 dark:text-gray-300">
                                {{ __('New Theme (Colorful)') }}
                            </label>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ __('Modern, vibrant design with playful colors and animations.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                id="theme-normal" 
                                name="default_theme" 
                                type="radio" 
                                value="normal" 
                                {{ ($defaultTheme ?? 'new') === 'normal' ? 'checked' : '' }}
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="theme-normal" class="font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Normal Theme (Classic)') }}
                            </label>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ __('Clean, professional design from previous versions.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('Save Default Theme') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('admin.settings.password_title') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('admin.settings.password_desc') }}</p>

            <form method="post" action="{{ route('password.update', ['locale' => app()->getLocale()]) }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.settings.label_current_password') }}</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($errors->updatePassword->get('current_password'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.settings.label_new_password') }}</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($errors->updatePassword->get('password'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.settings.label_confirm_password') }}</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($errors->updatePassword->get('password_confirmation'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('admin.settings.update_password') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
