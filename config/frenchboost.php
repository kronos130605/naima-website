<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Resource Levels
    |--------------------------------------------------------------------------
    | Canonical level slugs used for Videos and Worksheets. Keys are the DB
    | values; values are the English admin labels shown in selects and filters.
    */
    'levels' => [
        'beginner'     => 'Beginner (K–3)',
        'intermediate' => 'Intermediate (4–8)',
        'advanced'     => 'Advanced (9–12)',
        'general'      => 'General',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mind Map Groups
    |--------------------------------------------------------------------------
    | Canonical group slugs used for Mind Maps.
    */
    'mind_map_groups' => ['maternelle', 'primaire', 'college', 'lycee'],

    /*
    |--------------------------------------------------------------------------
    | Mind Map Group Labels
    |--------------------------------------------------------------------------
    | Display labels for mind map groups in admin forms.
    */
    'mind_map_group_labels' => [
        'maternelle' => 'Maternelle / Kindergarten',
        'primaire'   => 'Primaire / Elementary',
        'college'    => 'Collège / Middle School',
        'lycee'      => 'Lycée / High School',
    ],

    /*
    |--------------------------------------------------------------------------
    | French Grade Levels
    |--------------------------------------------------------------------------
    | French education system grade levels for Mind Map level field datalist.
    */
    'french_grade_levels' => [
        'Maternelle',
        'CP',
        'CE1',
        'CE2',
        'CM1',
        'CM2',
        '6ème',
        '5ème',
        '4ème',
        '3ème',
        '2nde',
        '1ère',
        'Terminale',
    ],

    /*
    |--------------------------------------------------------------------------
    | Topic Options
    |--------------------------------------------------------------------------
    | Suggested topics for resources (videos, worksheets, mind maps).
    | Used in admin form datalists.
    */
    'topics_en' => [
        'Grammar',
        'Conjugation',
        'Vocabulary',
        'Reading',
        'Writing',
        'Phonics',
        'Pronunciation',
        'Literature',
        'Spelling',
    ],

    'topics_fr' => [
        'Grammaire',
        'Conjugaison',
        'Vocabulaire',
        'Lecture',
        'Écriture',
        'Phonétique',
        'Prononciation',
        'Littérature',
        'Orthographe',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Navigation
    |--------------------------------------------------------------------------
    | Single source of truth for all admin tabs. Used by navigation.blade.php
    | (desktop + mobile) and admin-nav.blade.php.
    |
    | Keys:
    |   label_key — translation key for display text (admin.nav.*)
    |   route     — named Laravel route
    |   urlMatch  — substring matched against window.location.pathname (JS)
    |   pattern   — Str::is() pattern matched against route name (PHP)
    |   icon      — inline SVG string
    */
    'admin_nav' => [
        [
            'label_key' => 'dashboard',
            'route'     => 'dashboard',
            'urlMatch'  => '/dashboard',
            'pattern'   => 'dashboard',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
        ],
        [
            'label_key' => 'mind_maps',
            'route'     => 'admin.mind-maps.index',
            'urlMatch'  => '/admin/mind-maps',
            'pattern'   => 'admin.mind-maps.*',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
        ],
        [
            'label_key' => 'videos',
            'route'     => 'admin.videos.index',
            'urlMatch'  => '/admin/videos',
            'pattern'   => 'admin.videos.*',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
        ],
        [
            'label_key' => 'worksheets',
            'route'     => 'admin.worksheets.index',
            'urlMatch'  => '/admin/worksheets',
            'pattern'   => 'admin.worksheets.*',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
        ],
        [
            'label_key' => 'bookings',
            'route'     => 'admin.bookings.index',
            'urlMatch'  => '/admin/bookings',
            'pattern'   => 'admin.bookings.*',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
        ],
        [
            'label_key' => 'testimonials',
            'route'     => 'admin.testimonials.index',
            'urlMatch'  => '/admin/testimonials',
            'pattern'   => 'admin.testimonials.*',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>',
        ],
        [
            'label_key' => 'settings',
            'route'     => 'admin.settings',
            'urlMatch'  => '/admin/settings',
            'pattern'   => 'admin.settings',
            'icon'      => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        ],
    ],

];
