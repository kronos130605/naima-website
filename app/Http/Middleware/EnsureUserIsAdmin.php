<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdmin()) {
            $locale = $request->route('locale') ?? app()->getLocale();
            return redirect()->route('site.home', ['locale' => $locale]);
        }

        return $next($request);
    }
}
