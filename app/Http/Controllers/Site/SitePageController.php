<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\SiteContentService;
use Illuminate\Contracts\View\View;

class SitePageController extends Controller
{
    public function __construct(
        private readonly SiteContentService $siteContentService,
    ) {}

    public function about(): View
    {
        return view('site.about', $this->siteContentService->getHomeViewData());
    }

    public function programs(): View
    {
        return view('site.programs', $this->siteContentService->getHomeViewData());
    }

    public function method(): View
    {
        return view('site.method', $this->siteContentService->getHomeViewData());
    }

    public function pricing(): View
    {
        return view('site.pricing', $this->siteContentService->getHomeViewData());
    }

    public function faq(): View
    {
        return view('site.faq', $this->siteContentService->getHomeViewData());
    }

    public function contact(): View
    {
        return view('site.contact', $this->siteContentService->getHomeViewData());
    }
}
