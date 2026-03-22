<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Repositories\BookingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookingRepository $repo,
    ) {}

    public function show(): View
    {
        return view('site.booking', [
            'brand'   => ['name' => 'FrenchBoost'],
            'cta'     => ['booking_url' => null],
            'locale'  => app()->getLocale(),
            'locales' => ['en', 'fr'],
        ]);
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $this->repo->create(array_merge(
            $request->validated(),
            ['locale' => app()->getLocale()]
        ));

        return redirect()
            ->route('site.booking', ['locale' => app()->getLocale()])
            ->with('success', true);
    }
}
