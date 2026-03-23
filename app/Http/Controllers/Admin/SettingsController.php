<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->header('HX-Request')) {
            return view('admin.partials.settings', ['user' => $request->user()]);
        }

        return view('admin.settings.index', ['user' => $request->user()]);
    }
}
