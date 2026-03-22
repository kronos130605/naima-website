<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\SiteContentService;
use App\Services\WorksheetService;
use Illuminate\View\View;

class WorksheetController extends Controller
{
    public function __construct(
        private readonly WorksheetService $worksheetService,
        private readonly SiteContentService $siteContentService,
    ) {}

    public function __invoke(string $locale): View
    {
        $base       = $this->siteContentService->getHomeViewData();
        $worksheets = $this->worksheetService->getSiteData();

        return view('site.worksheets', array_merge($base, $worksheets));
    }
}
