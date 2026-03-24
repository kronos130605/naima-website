<?php

namespace App\Services\Site;

use App\Models\TestimonialPost;
use App\Repositories\Site\HomeContentRepository;

class SiteContentService
{
    public function __construct(
        private readonly HomeContentRepository $homeContentRepository,
    ) {
    }

    public function getHomeViewData(): array
    {
        $locale = app()->getLocale();
        $data = $this->homeContentRepository->get($locale);

        $data['locale'] = $locale;
        $data['locales'] = ['en', 'fr'];

        $dynamicTestimonials = TestimonialPost::visible()
            ->forLocale($locale)
            ->ordered()
            ->get()
            ->map(fn($post) => [
                'name' => $post->name,
                'role' => $post->role,
                'rating' => $post->rating,
                'body' => $post->body,
            ])
            ->toArray();

        if (!empty($dynamicTestimonials)) {
            $data['testimonials']['items'] = $dynamicTestimonials;
        }

        return $data;
    }
}
