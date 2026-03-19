<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\SiteContentService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly SiteContentService $siteContentService,
    ) {
    }

    public function __invoke(string $locale): View
    {
        return view('site.home', $this->siteContentService->getHomeViewData());
    }
}
