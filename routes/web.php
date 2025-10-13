<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PropertyAdvertisementController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    //return view('welcome');
    return view('pages.index');
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

    Route::post('/property-advertisements/store', [PropertyAdvertisementController::class, 'store'])->name('property-advertisements.store');
    //Route::post('/property-advertisements/store', function(StorePropertyRequest $request){dd($request->all());})->name('property-advertisements.store');

    Route::get('/property-advertisements/index', [PropertyAdvertisementController::class, 'index'])
        ->name('property-advertisements.index');


    Route::resource('cities', CityController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('towns', TownController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('sectors', SectorController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('blocks', BlockController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

    Route::get('/user/view', [UserController::class, 'index'])->name('profile.view');
    Route::get('/user/properties', [UserController::class, 'UserProperties'])->name('property.myproperties');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::get('/property/add', [PropertyAdvertisementController::class, 'add'])->name('property.add');
    Route::get('/property/MapSearch', [PropertyAdvertisementController::class, 'MapSearch'])->name('property.MapSearch');
});

// ✅ Search properties - accessible to any user (guest or authenticated)
Route::get('/property-advertisements/search', [PropertyAdvertisementController::class, 'search'])
    ->name('property-advertisements.search');
Route::get('/property-advertisements/view/{id}', [PropertyAdvertisementController::class, 'view'])
    ->name('property-advertisements.view');
Route::get('/property/{property}', function (App\Models\PropertyAdvertisement $property) {
    return view('property-detail-page', ['property' => $property]);
})->name('property.detail');


require __DIR__ . '/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.index');
    })->name('dashboard');
});
