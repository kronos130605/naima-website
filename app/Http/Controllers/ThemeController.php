<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'theme' => 'required|in:new,normal',
        ]);

        if (Auth::check()) {
            Auth::user()->update([
                'theme_preference' => $validated['theme'],
            ]);
        }

        return back()->with('success', __('Theme preference updated successfully.'));
    }
}
