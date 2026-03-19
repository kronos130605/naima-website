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
        $data = $this->homeContentRepository->get();

        $data['locale'] = app()->getLocale();
        $data['locales'] = ['en', 'fr'];

        return $data;
    }
}
