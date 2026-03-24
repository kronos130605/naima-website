<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialPost;
use App\Services\TestimonialPostService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonialPostController extends Controller
{
    public function __construct(
        private readonly TestimonialPostService $service,
    ) {
    }

    public function index(Request $request): View
    {
        $locale = $request->string('locale_filter')->toString();
        $locale = $locale !== '' ? $locale : null;

        $posts = $this->service->paginateForAdmin($locale);

        if ($request->header('HX-Request')) {
            return view('admin.partials.testimonial-posts', [
                'posts' => $posts,
                'localeFilter' => $locale,
            ]);
        }

        return view('admin.testimonial-posts.index', [
            'posts' => $posts,
            'localeFilter' => $locale,
        ]);
    }

    public function toggleVisibility(Request $request, string $locale, TestimonialPost $testimonialPost): RedirectResponse
    {
        $this->service->toggleVisibility($testimonialPost);

        $localeFilter = $request->string('locale_filter')->toString();

        return redirect()
            ->route('admin.testimonials.index', [
                'locale' => $locale,
                'locale_filter' => $localeFilter !== '' ? $localeFilter : null,
            ])
            ->with('success', __('Visibility updated successfully.'));
    }

    public function moveUp(Request $request, string $locale, TestimonialPost $testimonialPost): RedirectResponse
    {
        $this->service->moveUp($testimonialPost);

        $localeFilter = $request->string('locale_filter')->toString();

        return redirect()
            ->route('admin.testimonials.index', [
                'locale' => $locale,
                'locale_filter' => $localeFilter !== '' ? $localeFilter : null,
            ])
            ->with('success', __('Order updated successfully.'));
    }

    public function moveDown(Request $request, string $locale, TestimonialPost $testimonialPost): RedirectResponse
    {
        $this->service->moveDown($testimonialPost);

        $localeFilter = $request->string('locale_filter')->toString();

        return redirect()
            ->route('admin.testimonials.index', [
                'locale' => $locale,
                'locale_filter' => $localeFilter !== '' ? $localeFilter : null,
            ])
            ->with('success', __('Order updated successfully.'));
    }

    public function destroy(Request $request, string $locale, TestimonialPost $testimonialPost): RedirectResponse
    {
        $this->service->delete($testimonialPost);

        $localeFilter = $request->string('locale_filter')->toString();

        return redirect()
            ->route('admin.testimonials.index', [
                'locale' => $locale,
                'locale_filter' => $localeFilter !== '' ? $localeFilter : null,
            ])
            ->with('success', __('Testimonial deleted successfully.'));
    }
}
