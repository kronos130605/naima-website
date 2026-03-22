<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\SiteContentService;
use App\Services\VideoService;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function __construct(
        private readonly VideoService $videoService,
        private readonly SiteContentService $siteContentService,
    ) {}

    public function __invoke(string $locale): View
    {
        $base   = $this->siteContentService->getHomeViewData();
        $videos = $this->videoService->getSiteData();

        return view('site.videos', array_merge($base, $videos));
    }
}
