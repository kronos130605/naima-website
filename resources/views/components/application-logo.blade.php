<img
    src="{{ Vite::asset('resources/images/logo/logo_1_light.png') }}"
    alt="{{ config('app.name', 'FrenchBoost') }}"
    {{ $attributes->merge(['class' => 'h-8 w-auto object-contain dark:hidden']) }}
/>
<img
    src="{{ Vite::asset('resources/images/logo/logo_1_dark.png') }}"
    alt="{{ config('app.name', 'FrenchBoost') }}"
    {{ $attributes->merge(['class' => 'h-8 w-auto object-contain hidden dark:block']) }}
/>
