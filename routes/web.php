<?php

use App\Http\Controllers\Admin\MindMapController as AdminMindMapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MindMapController;
use App\Http\Middleware\SetLocaleFromRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/en');
});

Route::get('/login', fn () => redirect()->route('login', ['locale' => 'en']));
Route::get('/register', fn () => redirect()->route('register', ['locale' => 'en']));

Route::middleware(SetLocaleFromRoute::class)
    ->prefix('{locale}')
    ->where(['locale' => 'en|fr'])
    ->group(function () {
        Route::get('/', HomeController::class)->name('site.home');

        Route::get('/mind-maps', MindMapController::class)->name('site.mind-maps');

        Route::get('/videos', fn () => view('site.coming-soon', [
            'brand'   => ['name' => 'FrenchBoost'],
            'cta'     => ['booking_url' => null],
            'locale'  => app()->getLocale(),
            'locales' => ['en', 'fr'],
            'page'    => 'videos',
        ]))->name('site.videos');

        Route::get('/worksheets', fn () => view('site.coming-soon', [
            'brand'   => ['name' => 'FrenchBoost'],
            'cta'     => ['booking_url' => null],
            'locale'  => app()->getLocale(),
            'locales' => ['en', 'fr'],
            'page'    => 'worksheets',
        ]))->name('site.worksheets');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified', 'admin'])->name('dashboard');

        Route::middleware(['auth', 'verified', 'admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::get('/mind-maps', [AdminMindMapController::class, 'index'])->name('mind-maps.index');
                Route::get('/mind-maps/create', [AdminMindMapController::class, 'create'])->name('mind-maps.create');
                Route::post('/mind-maps', [AdminMindMapController::class, 'store'])->name('mind-maps.store');
                Route::get('/mind-maps/{mindMap}/edit', [AdminMindMapController::class, 'edit'])->name('mind-maps.edit');
                Route::put('/mind-maps/{mindMap}', [AdminMindMapController::class, 'update'])->name('mind-maps.update');
                Route::delete('/mind-maps/{mindMap}', [AdminMindMapController::class, 'destroy'])->name('mind-maps.destroy');
                Route::patch('/mind-maps/{mindMap}/toggle', [AdminMindMapController::class, 'togglePublish'])->name('mind-maps.toggle');
            });

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        require __DIR__.'/auth.php';
    });
