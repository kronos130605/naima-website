<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\TestimonialPostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialsController extends Controller
{
    public function __construct(
        private readonly TestimonialPostService $service,
    ) {
    }

    public function __invoke(Request $request): View
    {
        $locale = app()->getLocale();
        $data = $this->service->getTestimonialsPageData($locale);

        return view('site.testimonials', $data);
    }
}
