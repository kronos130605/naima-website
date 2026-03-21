<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\MindMapService;
use Illuminate\View\View;

class MindMapController extends Controller
{
    public function __construct(
        private readonly MindMapService $service,
    ) {}

    public function __invoke(): View
    {
        return view('site.mind-maps', array_merge(
            $this->service->getPublicViewData(),
            [
                'brand'   => ['name' => 'FrenchBoost'],
                'cta'     => ['booking_url' => null],
                'locale'  => app()->getLocale(),
                'locales' => ['en', 'fr'],
            ]
        ));
    }
}
