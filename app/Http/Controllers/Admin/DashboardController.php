<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('admin.partials.dashboard');
        }

        return view('dashboard');
    }
}
