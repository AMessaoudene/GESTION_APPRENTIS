<?php

use App\Http\Controllers\DecisionsApprentisController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PVInstallationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\StructuresController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\AssiduitesController;
use App\Http\Controllers\EvaluationApprentisController;
use App\Http\Controllers\EvaluationMaitreApprentisController;

Route::get('/', function () {
    return view('welcome');
});
//Structures
Route::get('/structures/ajouter', [StructuresController::class, 'index'])->name('structures.index');
Route::post('/structures/ajouter', [StructuresController::class, 'submit'])->name('structures.submit');
//Diplomes
Route::get('/diplomes', [DiplomesController::class, 'index'])->name('diplomes.index');
Route::post('/diplomes', [DiplomesController::class, 'store'])->name('diplomes.store');
Route::get('/diplomes/print', [DiplomesController::class, 'generatePDF'])->name('diplomes.print');
Route::get('/diplomes/{id}/edit', [DiplomesController::class, 'edit'])->name('diplomes.edit');
Route::put('diplomes/{id}', [DiplomesController::class, 'update'])->name('diplomes.update');
Route::delete('/diplomes/{id}', [DiplomesController::class, 'destroy'])->name('diplomes.destroy');
//Apprentis
Route::get('/apprentis', [ApprentisController::class, 'index'])->name('apprentis.index');
Route::post('/apprentis', [ApprentisController::class, 'submit'])->name('apprentis.submit');
Route::get('/apprentis/{id}/edit', [ApprentisController::class, 'edit'])->name('apprentis.edit');
Route::put('/apprentis/{id}', [ApprentisController::class, 'update'])->name('apprentis.update');
Route::delete('/apprentis/{id}', [ApprentisController::class, 'destroy'])->name('apprentis.destroy');
//pvs
Route::get('/apprentis/pvinstallations', [PVInstallationsController::class, 'index'])->name('pvinstallations.index');
Route::post('/apprentis/pvinstallations', [PVInstallationsController::class, 'submit'])->name('pvinstallations.submit');
//Fichiers
Route::get('/apprentis/dossiers', [DossiersController::class, 'index'])->name('dossiers.index');
Route::post('/apprentis/dossiers', [DossiersController::class, 'store'])->name('dossiers.store');
//Maitre Apprentis
Route::get('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'index'])->name('maitreapprentis.index');
Route::post('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
Route::put('/maitreapprentis/ajouter', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
//decisionsapprentis
Route::get('/decisionsapprentis', [DecisionsApprentisController::class, 'index'])->name('decisions.index');
// Evaluation maitre apprentis
Route::get('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'index'])->name('evaluation_maitre_apprentis.index');
Route::post('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
Route::put('/evaluation_maitre_apprentis/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluation_maitre_apprentis.submit');
// Evaluation apprentis
Route::get('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'index'])->name('evaluation_apprentis.index');
Route::post('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
Route::put('/evaluation_apprentis/ajouter', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
//Assiduites
Route::get('/assiduites/ajouter', [AssiduitesController::class, 'index'])->name('assiduites.index');
Route::post('/assiduites/ajouter', [AssiduitesController::class, 'submit'])->name('assiduites.submit');
Route::get('/assiduites/consulter', [AssiduitesController::class, 'show'])->name('assiduites.consulter');
Route::get('/assiduites/details/{id}', [AssiduitesController::class, 'details'])->name('assiduites.details');
Route::post('/assiduites/details/{id}', [AssiduitesController::class, 'details'])->name('assiduites.details');
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
