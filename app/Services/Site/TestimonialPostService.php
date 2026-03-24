<?php

namespace App\Services\Site;

use App\Repositories\Site\TestimonialPostRepository;

class TestimonialPostService
{
    public function __construct(
        private readonly TestimonialPostRepository $repo,
    ) {
    }

    public function getTestimonialsPageData(string $locale): array
    {
        $posts = $this->repo->visibleForLocale($locale);

        return [
            'locale' => $locale,
            'locales' => ['en', 'fr'],
            'brand' => ['name' => 'FrenchBoost'],
            'cta' => ['booking_url' => null],
            'posts' => $posts,
        ];
    }
}
