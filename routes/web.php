<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MindMapController as AdminMindMapController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\TestimonialPostController as AdminTestimonialPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\BookingController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SitePageController;
use App\Http\Controllers\Site\TestimonialPostController;
use App\Http\Controllers\Site\TestimonialsController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\WorksheetController as AdminWorksheetController;
use App\Http\Controllers\Site\MindMapController;
use App\Http\Controllers\Site\VideoController;
use App\Http\Controllers\Site\WorksheetController;
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

        Route::get('/about',    [SitePageController::class, 'about'])->name('site.about');
        Route::get('/programs', [SitePageController::class, 'programs'])->name('site.programs');
        Route::get('/method',   [SitePageController::class, 'method'])->name('site.method');
        Route::get('/pricing',  [SitePageController::class, 'pricing'])->name('site.pricing');
        Route::get('/faq',      [SitePageController::class, 'faq'])->name('site.faq');
        Route::get('/contact',  [SitePageController::class, 'contact'])->name('site.contact');

        Route::get('/book-free-assessment', [BookingController::class, 'show'])->name('site.booking');
        Route::post('/book-free-assessment', [BookingController::class, 'store'])->name('site.booking.store');

        Route::get('/videos', VideoController::class)->name('site.videos');

        Route::get('/worksheets', WorksheetController::class)->name('site.worksheets');

        Route::get('/testimonials', TestimonialsController::class)->name('site.testimonials');

        Route::post('/testimonials', [TestimonialPostController::class, 'store'])->middleware('auth')->name('site.testimonials.store');

        Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified', 'admin'])->name('dashboard');

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

                Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
                Route::patch('/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.status');

                Route::get('/videos', [AdminVideoController::class, 'index'])->name('videos.index');
                Route::get('/videos/create', [AdminVideoController::class, 'create'])->name('videos.create');
                Route::post('/videos', [AdminVideoController::class, 'store'])->name('videos.store');
                Route::get('/videos/{video}/edit', [AdminVideoController::class, 'edit'])->name('videos.edit');
                Route::put('/videos/{video}', [AdminVideoController::class, 'update'])->name('videos.update');
                Route::delete('/videos/{video}', [AdminVideoController::class, 'destroy'])->name('videos.destroy');
                Route::patch('/videos/{video}/toggle', [AdminVideoController::class, 'togglePublish'])->name('videos.toggle');

                Route::get('/worksheets', [AdminWorksheetController::class, 'index'])->name('worksheets.index');
                Route::get('/worksheets/create', [AdminWorksheetController::class, 'create'])->name('worksheets.create');
                Route::post('/worksheets', [AdminWorksheetController::class, 'store'])->name('worksheets.store');
                Route::get('/worksheets/{worksheet}/edit', [AdminWorksheetController::class, 'edit'])->name('worksheets.edit');
                Route::put('/worksheets/{worksheet}', [AdminWorksheetController::class, 'update'])->name('worksheets.update');
                Route::delete('/worksheets/{worksheet}', [AdminWorksheetController::class, 'destroy'])->name('worksheets.destroy');
                Route::patch('/worksheets/{worksheet}/toggle', [AdminWorksheetController::class, 'togglePublish'])->name('worksheets.toggle');

                Route::get('/testimonials', [AdminTestimonialPostController::class, 'index'])->name('testimonials.index');
                Route::patch('/testimonials/{testimonialPost}/toggle', [AdminTestimonialPostController::class, 'toggleVisibility'])->name('testimonials.toggle');
                Route::post('/testimonials/{testimonialPost}/up', [AdminTestimonialPostController::class, 'moveUp'])->name('testimonials.up');
                Route::post('/testimonials/{testimonialPost}/down', [AdminTestimonialPostController::class, 'moveDown'])->name('testimonials.down');
                Route::delete('/testimonials/{testimonialPost}', [AdminTestimonialPostController::class, 'destroy'])->name('testimonials.destroy');

                Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
                Route::post('/settings/default-theme', [AdminSettingsController::class, 'updateDefaultTheme'])->name('settings.default-theme');
            });

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            Route::post('/theme', [ThemeController::class, 'update'])->name('theme.update');
        });

        require __DIR__.'/auth.php';
    });
