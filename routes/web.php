<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PropertyAdvertisementController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\BlockController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/pages', function () {
    return view('pages.index');
})->name('pages');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    // ✅ Create a new property advertisement - only for authenticated users
    Route::get('/property-advertisements', [PropertyAdvertisementController::class, 'index'])
        ->name('property-advertisements.index');

    Route::post('/property-advertisements', [PropertyAdvertisementController::class, 'store'])
        ->name('property-advertisements.store');

        Route::resource('cities', CityController::class)->only(['index','show','store','update','destroy']);
        Route::resource('towns', TownController::class)->only(['index','show','store','update','destroy']);
        Route::resource('sectors', SectorController::class)->only(['index','show','store','update','destroy']);
        Route::resource('blocks', BlockController::class)->only(['index','show','store','update','destroy']);



});

// ✅ Search properties - accessible to any user (guest or authenticated)
Route::get('/property-advertisements/search', [PropertyAdvertisementController::class, 'search'])
    ->name('property-advertisements.search');
    
require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
