<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('homepage.index');
})->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
     Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});



Route::resource('battles', BattleController::class);

Route::get('/battles', [BattleController::class, 'index'])->name('battles.index');
Route::get('/battles{battle}',[BattleController::class,'show'])->name('battles.show');

Route::middleware('auth')->group(function () {
    Route::get('/battles/create', [BattleController::class, 'create'])->name('battles.create');
    Route::post('/battles', [BattleController::class, 'store'])->name('battles.store');
});

Route::resource('memes', MemeController::class);

Route::get('/memes', [MemeController::class, 'index'])->name('memes.index');
Route::get('/memes/{meme}', [MemeController::class, 'show'])->name('memes.show');

Route::middleware('auth')->group(function () {
    Route::get('/battles/{battle}/memes/create', [MemeController::class, 'create'])->name('battles.memes.create');
    Route::post('/battles/{battle}/memes', [MemeController::class, 'store'])->name('battles.memes.store');
});



Route::middleware('auth')->group(function () {
    Route::get('/battles/{battle}/edit', [BattleController::class, 'edit'])->name('battles.edit');
    Route::put('/battles/{battle}', [BattleController::class, 'update'])->name('battles.update');
});

Route::middleware('auth')->group(function () {
   
    Route::get('/memes/{meme}/edit', [MemeController::class, 'edit'])->name('memes.edit');
    Route::put('/memes/{meme}', [MemeController::class, 'update'])->name('memes.update');
});


Route::middleware('auth')->group(function () {
    Route::post('/battles/{battle}/memes/{meme}/vote', [VoteController::class, 'store'])
        ->name('votes.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/battles', [ProfileController::class, 'myBattles'])->name('profile.my-battles');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/my-memes', [ProfileController::class, 'myMemes'])->name('profile.my-memes');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get('/memes/{meme}/download', [MemeController::class, 'download'])->name('memes.download');

   







require __DIR__.'/auth.php';
