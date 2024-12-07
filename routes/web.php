<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameInviteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game/{gameId?}', function () {
    return view('game');
})->middleware(['auth', 'verified'])->name('game');

// Route to generate invite link
Route::get('/game/generate-link', [GameInviteController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('game.generate-link');

Route::post('/game/invite', [GameInviteController::class, 'sendInvite'])
    ->middleware(['auth', 'verified'])
    ->name('game.invite');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
