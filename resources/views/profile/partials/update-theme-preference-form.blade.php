<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Theme Preference') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Choose between the new colorful theme or the classic normal theme.') }}
        </p>
    </header>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded dark:bg-green-900/30 dark:border-green-600 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('theme.update', ['locale' => app()->getLocale()]) }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                {{ __('Select Theme') }}
            </label>

            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input 
                            id="theme-new" 
                            name="theme" 
                            type="radio" 
                            value="new" 
                            {{ (Auth::user()->theme_preference ?? 'new') === 'new' ? 'checked' : '' }}
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="theme-new" class="font-medium text-gray-700 dark:text-gray-300">
                            {{ __('New Theme (Colorful)') }}
                        </label>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ __('Modern, vibrant design with playful colors and animations from the latest update.') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input 
                            id="theme-normal" 
                            name="theme" 
                            type="radio" 
                            value="normal" 
                            {{ (Auth::user()->theme_preference ?? 'new') === 'normal' ? 'checked' : '' }}
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 dark:bg-gray-700"
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
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Theme Preference') }}</x-primary-button>
        </div>
    </form>
</section>
