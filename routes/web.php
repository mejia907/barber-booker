<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\Clients\{Index as ClientsIndex, Create as ClientsCreate, Edit as ClientsEdit};
use App\Livewire\Services\{Index as ServicesIndex, Create as ServicesCreate, Edit as ServicesEdit};
use App\Livewire\Employees\{Index as EmployeesIndex, Create as EmployeesCreate, Edit as EmployeesEdit};

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

    // Módulo de Clientes
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', ClientsIndex::class)->name('index');
        Route::get('/create', ClientsCreate::class)->name('create');
        Route::get('/edit/{client}', ClientsEdit::class)->name('edit');
    });

    // Módulo de Servicios
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', ServicesIndex::class)->name('index');
        Route::get('/create', ServicesCreate::class)->name('create');
        Route::get('/edit/{service}', ServicesEdit::class)->name('edit');
    });

    // Módulo de Empleados
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', EmployeesIndex::class)->name('index');
        Route::get('/create', EmployeesCreate::class)->name('create');
        Route::get('/edit/{employee}', EmployeesEdit::class)->name('edit');
    });
});



require __DIR__ . '/auth.php';
