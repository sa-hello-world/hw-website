<?php

use App\Http\Controllers\Board\EventController as BoardEventController;
use App\Http\Controllers\Board\SchoolYearController as BoardSchoolYearController;
use App\Http\Controllers\Board\SponsorController as BoardSponsorController;
use App\Http\Controllers\Board\PaymentController as BoardPaymentController;
use App\Http\Controllers\Board\UserController;
use App\Http\Controllers\Home\EventController as HomeEventController;
use App\Http\Controllers\Home\PaymentController as HomePaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicController;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('welcome');

Route::get('/aboutus', [PublicController::class, 'aboutUs'])->name('aboutus');

Route::get('/partners', [PublicController::class, 'partners'])->name('partners');

Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'send'])->name('contact.send')
    ->middleware('throttle:3,1');

Route::get('/events', [PublicController::class, 'events'])->name('events');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::prefix('board')->group(function () {
        Route::resource('sponsors', BoardSponsorController::class)->except(['show']);
        Route::resource('events', BoardEventController::class)->except(['show']);
        Route::resource('school-years', BoardSchoolYearController::class)->except(['show']);
        Route::resource('payments', BoardPaymentController::class)
            ->only(['index'])->names(['index' => 'board.payments.index']);
        Route::get('/users', [UserController::class, 'index'])->name('board.users.index');
    });

    Route::prefix('my')->group(function () {
        Route::get('/payments', [HomePaymentController::class, 'index'])->name('my.payments.index');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('my.payments.show');
        Route::get('/events', [HomeEventController::class, 'index'])->name('my.events.index');
        Route::get('/event/{event}', [HomeEventController::class, 'show'])->name('my.events.show');
    });

    Route::post('/payments/membership/{membershipType}', [PaymentController::class, 'storeForMembership'])->name('payments.store.membership');
    Route::post('/payments/event/{event}', [PaymentController::class, 'storeForEvent'])->name('payments.store.event');
    Route::get('/payment/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payment/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
    Route::get('/payment/{payment}/callback', [PaymentController::class, 'callback'])->name('payments.callback');
    Route::post('/payment/prepare/{payment}', [PaymentController::class, 'prepare'])->name('payments.prepare');

    Route::post('/event/{event}/register', [HomeEventController::class, 'register'])->name('events.register');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
});

require __DIR__.'/auth.php';
