<?php

namespace App\Services\Site;

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

        return $data;
    }
}
