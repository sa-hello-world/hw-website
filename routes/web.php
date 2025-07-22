<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\Sponsor;

Route::get('/', function () {
    $events = Event::latest()->take(3)->get();
    $sponsors = Sponsor::all();

    return view('welcome', compact('events', 'sponsors'));
})->name('welcome');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
