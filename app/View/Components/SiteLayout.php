<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SiteLayout extends Component
{
    public function __construct(
        public string $title = 'FrenchBoost',
        public array $brand = [],
        public array $cta = [],
        public string $locale = 'en',
        public array $locales = ['en', 'fr'],
    ) {}

    public function render(): View
    {
        return view('layouts.site');
    }
}
