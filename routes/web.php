<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return auth()->user()->isManager()
        ? redirect()->route('location.dashboard')
        : redirect()->route('shift.index');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::post('/location/update', [LocationController::class, 'store'])->name('location.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/map', [LocationController::class, 'dashboard'])->name('location.dashboard');
    Route::get('/dashboard/map/data', [LocationController::class, 'liveData'])->name('location.data');
});
require __DIR__.'/auth.php';
