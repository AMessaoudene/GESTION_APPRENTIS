<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\DiplomesController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/apprentis/ajouter', [ApprentisController::class, 'index']);
Route::post('/apprentis/ajouter', [ApprentisController::class, 'submit'])->name('apprentis.submit');
Route::put('/apprentis/ajouter', [ApprentisController::class, 'submit'])->name('apprentis.submit');
Route::get('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'index']);
Route::post('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
Route::put('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
Route::get('/diplomes/ajouter', [DiplomesController::class, 'index']);
Route::post('/diplomes/ajouter', [DiplomesController::class, 'submit'])->name('diplomes.submit');
Route::put('/diplomes/ajouter', [DiplomesController::class, 'submit'])->name('diplomes.submit');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
