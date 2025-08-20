<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Board\EventController;
use App\Http\Controllers\Board\SchoolYearController;
use App\Http\Controllers\Board\SponsorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

Route::get('/partners', function () {
    return view('partners');
})->name('partners');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::prefix('board')->group(function () {
        Route::resource('sponsors', SponsorController::class)->except(['show']);
        Route::resource('events', EventController::class)->except(['show']);
        Route::resource('school-years', SchoolYearController::class)->except(['show']);
    });

    Route::post('/payments/membership/{membershipType}', [PaymentController::class, 'storeForMembership'])->name('payments.store.membership');
    Route::get('/payment/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payment/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
    Route::get('/payment/{payment}/callback', [PaymentController::class, 'callback'])->name('payments.callback');
    Route::post('/payment/prepare/{payment}', [PaymentController::class, 'prepare'])->name('payments.prepare');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
