<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilisateursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\StructuresController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\EvaluationApprentisController;
use App\Http\Controllers\EvaluationMaitreApprentisController;

Route::get('/', function () {
    return view('welcome');
});
//utilisateurs
Route::get('/utilisateurs/ajouter', [UtilisateursController::class, 'index'])->name('utilisateurs.index');
Route::post('/utilisateurs/ajouter', [UtilisateursController::class, 'submit'])->name('utilisateurs.submit');
Route::get('/utilisateurs/completion', [UtilisateursController::class, 'insertion'])->name('utilisateurs.insertion');
Route::post('/utilisateurs/completion', [UtilisateursController::class, 'completion'])->name('utilisateurs.completion');
Route::get('/utilisateurs/consulter', [UtilisateursController::class, 'consulter'])->name('utilisateurs.consulter');
Route::get('/utilisateurs/details/{id}', [UtilisateursController::class, 'details'])->name('utilisateurs.details');
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
// Evaluation maitre apprentis
Route::get('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'index'])->name('evaluation_maitre_apprentis.index');
Route::post('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
Route::put('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
// Evaluation apprentis
Route::get('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'index'])->name('evaluation_apprentis.index');
Route::post('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
Route::put('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
//Structures
Route::get('/structures/ajouter', [StructuresController::class, 'index'])->name('structures.index');
Route::post('/structures/ajouter', [StructuresController::class, 'submit'])->name('structures.submit');
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
