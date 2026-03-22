<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\MindMapService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MindMapController extends Controller
{
    public function __construct(
        private readonly MindMapService $service,
    ) {}

    public function __invoke(Request $request): View
    {
        $data = array_merge(
            $this->service->getPublicViewData($request->query('group')),
            [
                'locale' => app()->getLocale(),
            ]
        );

        if ($request->header('HX-Request')) {
            return view('site.partials.mind-map-cards', $data);
        }

        return view('site.mind-maps', array_merge($data, [
            'brand'   => ['name' => 'FrenchBoost'],
            'cta'     => ['booking_url' => null],
            'locales' => ['en', 'fr'],
        ]));
    }
}
