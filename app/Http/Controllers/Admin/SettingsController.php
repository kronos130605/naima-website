<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $defaultTheme = SiteSetting::get('default_theme', 'new');
        
        if ($request->header('HX-Request')) {
            return view('admin.partials.settings', [
                'user' => $request->user(),
                'defaultTheme' => $defaultTheme,
            ]);
        }

        return view('admin.settings.index', [
            'user' => $request->user(),
            'defaultTheme' => $defaultTheme,
        ]);
    }

    public function updateDefaultTheme(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'default_theme' => 'required|in:new,normal',
        ]);

        SiteSetting::set('default_theme', $validated['default_theme']);

        return back()->with('success', __('Default theme updated successfully.'));
    }
}
