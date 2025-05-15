<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\Clients\Index;
use App\Livewire\Clients\Create;
use App\Livewire\Clients\Edit;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/clients', Index::class)->name('clients.index');
    Route::get('/clients/create', Create::class)->name('clients.create');
    Route::get('/clients/edit/{client}', Edit::class)->name('clients.edit');
});



require __DIR__ . '/auth.php';
