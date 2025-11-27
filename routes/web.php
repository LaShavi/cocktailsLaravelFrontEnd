<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CocktailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para cócteles
    Route::get('/cocktails', [CocktailController::class, 'index'])->name('cocktails.index');
    Route::post('/cocktails', [CocktailController::class, 'store'])->name('cocktails.store');
    Route::get('/favorites', [CocktailController::class, 'show'])->name('cocktails.favorites');
    Route::delete('/cocktails/{cocktail}', [CocktailController::class, 'destroy'])->name('cocktails.destroy');
});

require __DIR__.'/auth.php';
