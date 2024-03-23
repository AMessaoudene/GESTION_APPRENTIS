<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\EvaluationApprentisController;
use App\Http\Controllers\EvaluationMaitreApprentisController;

Route::get('/', function () {
    return view('welcome');
});
//utilisateurs
Route::get('/utilisateurs/ajouter', [ApprentisController::class, 'index'])->name('utilisateurs.index');
Route::post('/utilisateurs/ajouter', [ApprentisController::class, 'submit'])->name('utilisateurs.submit');
Route::put('/utilisateurs/ajouter', [ApprentisController::class, 'submit'])->name('utilisateurs.submit');
Route::get('/utilisateurs/consulter', [ApprentisController::class, 'consulter'])->name('utilisateurs.consulter');
//Apprentis
Route::get('/apprentis/ajouter', [ApprentisController::class, 'index'])->name('apprentis.index');
Route::post('/apprentis/ajouter', [ApprentisController::class, 'submit'])->name('apprentis.submit');
Route::put('/apprentis/ajouter', [ApprentisController::class, 'submit'])->name('apprentis.submit');
//Maitre Apprentis
Route::get('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'index'])->name('maitreapprentis.index');
Route::post('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
Route::put('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
//Diplomes
Route::get('/diplomes/ajouter', [DiplomesController::class, 'index'])->name('diplomes.index');
Route::post('/diplomes/ajouter', [DiplomesController::class, 'submit'])->name('diplomes.submit');
Route::put('/diplomes/ajouter', [DiplomesController::class, 'submit'])->name('diplomes.submit');
Route::get('/diplomes/consulter', [DiplomesController::class,'consulter'])->name('diplomes.consulter');
Route::get('/diplomes/details/{id}', [DiplomesController::class,'details'])->name('diplomes.details');
Route::post('/diplomes/details/{id}', [DiplomesController::class,'modifier']);
// Evaluation maitre apprentis
Route::get('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'index'])->name('evaluation_maitre_apprentis.index');
Route::post('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
Route::put('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
// Evaluation apprentis
Route::get('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'index'])->name('evaluation_apprentis.index');
Route::post('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
Route::put('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
