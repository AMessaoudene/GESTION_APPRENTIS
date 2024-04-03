<?php

use App\Http\Controllers\DecisionsApprentisController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PVInstallationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\StructuresController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\AssiduitesController;
use App\Http\Controllers\EvaluationApprentisController;
use App\Http\Controllers\EvaluationMaitreApprentisController;
use App\Http\Controllers\PlanBesoinsController;
use App\Http\Controllers\ParametresController;
use App\Http\Controllers\ExercicesController;

Route::get('/', function () {
    return view('welcome');
});
//Structures
Route::get('/structures', [StructuresController::class, 'index'])->name('structures.index');
Route::post('/structures', [StructuresController::class, 'submit'])->name('structures.submit');
Route::put('/structures/{id}', [StructuresController::class, 'update'])->name('structures.update');
Route::delete('/structures/{id}', [StructuresController::class, 'destroy'])->name('structures.destroy');
//Diplomes
Route::get('/diplomes', [DiplomesController::class, 'index'])->name('diplomes.index');
Route::post('/diplomes', [DiplomesController::class, 'store'])->name('diplomes.store');
Route::put('/diplomes/{id}', [DiplomesController::class, 'update'])->name('diplomes.update');
Route::delete('/diplomes/{id}', [DiplomesController::class, 'destroy'])->name('diplomes.destroy');
//Apprentis
Route::get('/apprentis', [ApprentisController::class, 'index'])->name('apprentis.index');
Route::post('/apprentis', [ApprentisController::class, 'submit'])->name('apprentis.submit');
Route::get('/apprentis/{id}/edit', [ApprentisController::class, 'edit'])->name('apprentis.edit');
Route::put('/apprentis/{id}', [ApprentisController::class, 'update'])->name('apprentis.update');
Route::delete('/apprentis/{id}', [ApprentisController::class, 'destroy'])->name('apprentis.destroy');
//pvs
Route::get('/apprentis/pvinstallations', [PVInstallationsController::class, 'index'])->name('pvinstallations.index');
Route::post('/apprentis/pvinstallations', [PVInstallationsController::class, 'store'])->name('pvinstallations.store');
Route::get('/apprentis/pvinstallations/fiche', [FicheController::class, 'index'])->name('fiche.download');
//Dossiers 
Route::get('/apprentis/dossiers', [DossiersController::class, 'index'])->name('dossiers.index');
Route::post('/apprentis/dossiers', [DossiersController::class, 'store'])->name('dossiers.store');
Route::get('/download/{id}', [DossiersController::class, 'pdfdownload'])->name('dossiers.pdfdownload');
//Maitre Apprentis
Route::get('/maitreapprentis', [MaitreApprentisController::class, 'index'])->name('maitreapprentis.index');
Route::post('/maitreapprentis', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
Route::put('/maitreapprentis', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
//decisionsapprentis
Route::get('/decisionsapprentis', [DecisionsApprentisController::class, 'index'])->name('decisions.index');
// Evaluation maitre apprentis
Route::get('/evaluationMA/ajouter', [EvaluationMaitreApprentisController::class, 'index'])->name('evaluationMA.index');
Route::post('/evaluationMA/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluationMA.submit');
Route::put('/evaluationMA/ajouter', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluationMA.submit');
// Evaluation apprentis
Route::get('/apprentis/Evaluer', [EvaluationApprentisController::class, 'index'])->name('evaluation_apprentis.index');
Route::post('/apprentis/Evaluer', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
Route::put('/apprentis/Evaluer', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
//Assiduites
Route::get('/assiduites/ajouter', [AssiduitesController::class, 'index'])->name('assiduites.index');
Route::post('/assiduites/ajouter', [AssiduitesController::class, 'submit'])->name('assiduites.submit');
Route::get('/assiduites/consulter', [AssiduitesController::class, 'show'])->name('assiduites.consulter');
Route::get('/assiduites/details/{id}', [AssiduitesController::class, 'details'])->name('assiduites.details');
Route::post('/assiduites/details/{id}', [AssiduitesController::class, 'details'])->name('assiduites.details');
//plan besoins
Route::get('/planbesoins', [PlanBesoinsController::class, 'index'])->name('planbesoins.index');
Route::post('/planbesoins', [PlanBesoinsController::class, 'store'])->name('planbesoins.store');
Route::put('/planbesoins/{id}', [PlanBesoinsController::class, 'update'])->name('planbesoins.update');
Route::delete('/planbesoins/{id}', [PlanBesoinsController::class, 'destroy'])->name('planbesoins.destroy');
//parametres
Route::get('/parametres', [ParametresController::class, 'index'])->name('parametres.index');
Route::post('/parametres', [ParametresController::class, 'store'])->name('parametres.store');
//exercices
Route::get('/exercices', [ExercicesController::class, 'index'])->name('exercices.index');
Route::post('/exercices', [ExercicesController::class, 'store'])->name('exercices.store');
Route::put('/exercices/{id}', [exercicesController::class, 'update'])->name('exercices.update');
Route::delete('/exercices/{id}', [exercicesController::class, 'destroy'])->name('exercices.destroy');
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
