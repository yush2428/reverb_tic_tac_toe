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

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/game/{gameId}', [GameInviteController::class, 'show'])->name('game');
    Route::get('/generate-game-link', [GameInviteController::class, 'create'])->name('generate-link');
    Route::post('/game/invite', [GameInviteController::class, 'sendInvite'])->name('game.invite');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
