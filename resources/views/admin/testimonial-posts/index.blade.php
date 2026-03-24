<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Testimonials') }}
        </h2>
    </x-slot>

    @include('admin.partials.testimonial-posts', ['posts' => $posts, 'localeFilter' => $localeFilter ?? null])
</x-app-layout>
