<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Middleware\SetLocaleFromRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/en');
});

Route::middleware(SetLocaleFromRoute::class)
    ->where(['locale' => 'en|fr'])
    ->group(function () {
        Route::get('/{locale}', HomeController::class)->name('site.home');
    });
