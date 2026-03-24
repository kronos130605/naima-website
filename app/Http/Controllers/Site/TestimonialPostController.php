<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\TestimonialPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialPostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'body' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        TestimonialPost::create([
            'user_id' => Auth::id(),
            'locale' => app()->getLocale(),
            'name' => $validated['name'],
            'role' => $validated['role'],
            'body' => $validated['body'],
            'rating' => $validated['rating'],
            'is_visible' => false,
            'display_order' => 0,
        ]);

        return back()->with('success', __('Your testimonial has been submitted and is pending approval.'));
    }
}
