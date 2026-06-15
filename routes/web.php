<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

// مسارات المباريات
Route::resource('games', 'GameController');
Route::get('/games/live', [GameController::class, 'live'])->name('games.live');
Route::get('/games/upcoming', [GameController::class, 'upcoming'])->name('games.upcoming');

// مسارات القنوات
Route::resource('channels', 'ChannelController');

// مسارات الفرق
Route::resource('teams', 'TeamController');

// مسار البث المباشر
Route::get('/watch/{game}', function ($game) {
    $game = \App\Models\Game::with(['teamA', 'teamB', 'channel'])->findOrFail($game);
    return view('watch', compact('game'));
})->name('watch');
