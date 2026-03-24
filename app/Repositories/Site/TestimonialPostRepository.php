<?php

namespace App\Repositories\Site;

use App\Models\TestimonialPost;
use Illuminate\Support\Collection;

class TestimonialPostRepository
{
    public function visibleForLocale(string $locale): Collection
    {
        return TestimonialPost::visible()
            ->forLocale($locale)
            ->ordered()
            ->get();
    }
}
