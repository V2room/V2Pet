<?php

use App\Http\Controllers\AI\PresetController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::redirect('/', '/dashboard')->name('main');
Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');

Route::resource('card', CardController::class);
Route::prefix('card')->name('card.')->group(function () {
    Route::prefix('ai')->name('ai.')->group(function () {
        Route::post('preset', [PresetController::class, 'generate'])->name('preset.generate');
    });
});

require __DIR__ . '/auth.php';
