<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\Sponsor;

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
    Route::resource('sponsors', SponsorController::class)
        ->except(['show']);

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
