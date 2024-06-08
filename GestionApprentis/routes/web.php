<?php

use App\Http\Controllers\DecisionsApprentisController;
use App\Http\Controllers\baremesController;
use App\Http\Controllers\EvaluateurGrade\EvaluateurGradeController;
use App\Http\Controllers\RefSalariairesController;
use App\Http\Controllers\sidenavController;
use App\Http\Controllers\specialitesController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PVInstallationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprentisController;
use App\Http\Controllers\StructuresController;
use App\Http\Controllers\MaitreApprentisController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\AvenantsController;
use App\Http\Controllers\AssiduitesController;
use App\Http\Controllers\EvaluationApprentisController;
use App\Http\Controllers\EvaluationMaitreApprentisController;
use App\Http\Controllers\PlanBesoinsController;
use App\Http\Controllers\ParametresController;
use App\Http\Controllers\ExercicesController;
use App\Http\Controllers\DecisionsController;
use App\Http\Controllers\DFP\DFPController;
use App\Http\Controllers\SA\SAsController;
use App\Http\Controllers\DRH\DRHController;
use App\Http\Controllers\DepartsController;
use App\Http\Controllers\ComptesController;
use App\Http\Controllers\SupervisionsController;

Route::get('/', function () {
    return view('welcome');
});
//Structures
Route::middleware('auth')->group(function(){
    Route::get('/structures', [StructuresController::class, 'index'])->name('structures.index');
    Route::post('/structures', [StructuresController::class, 'submit'])->name('structures.submit');
    Route::put('/structures/{id}', [StructuresController::class, 'update'])->name('structures.update');
    Route::delete('/structures/{id}', [StructuresController::class, 'destroy'])->name('structures.destroy'); 
});
//Diplomes
Route::middleware('auth')->group(function(){
    Route::get('/diplomes', [DiplomesController::class, 'index'])->name('diplomes.index');
    Route::post('/diplomes', [DiplomesController::class, 'store'])->name('diplomes.store');
    Route::put('/diplomes/{id}', [DiplomesController::class, 'update'])->name('diplomes.update');
    Route::delete('/diplomes/{id}', [DiplomesController::class, 'destroy'])->name('diplomes.destroy');
});
//Supervisions
Route::middleware('auth')->group(function(){
    Route::get('/supervisions', [supervisionsController::class, 'index'])->name('supervisions.index');
    Route::post('/supervisions', [supervisionsController::class, 'submit'])->name('supervisions.submit');
    Route::put('/supervisions/{id}', [supervisionsController::class, 'update'])->name('supervisions.update');
    Route::delete('/supervisions/{id}', [supervisionsController::class, 'destroy'])->name('supervisions.destroy');
});
//Apprentis
Route::middleware('auth')->group(function(){
    Route::get('/apprentis', [ApprentisController::class, 'index'])->name('apprentis.index');
    Route::post('/apprentis', [ApprentisController::class, 'submit'])->name('apprentis.submit');
    Route::get('/apprentis/consulter', [ApprentisController::class, 'consulter'])->name('apprentis.consulter');
    Route::get('/apprentis/details/{id}',[ApprentisController::class,'details'])->name('apprentis.details');
    Route::post('/apprentis/details/{id}',[ApprentisController::class,'updatedossier'])->name('apprentis.updatedossier');
    Route::delete('/apprentis/fichiers/delete/{id}/{fichier}', [DossiersController::class, 'deletefichier'])->name('dossiers.deletefichier');
    Route::put('/apprentis/{id}', [ApprentisController::class, 'update'])->name('apprentis.update');
    Route::delete('/apprentis/consulter/{id}', [ApprentisController::class, 'destroy'])->name('apprentis.destroy');
    Route::get('/apprentis/{id}/HistoriqueMA',[ApprentisController::class,'HistoriqueMA'])->name('apprentis.HistoriqueMA');
    Route::get('/apprentis/{id}/HistoriqueAssiduites',[ApprentisController::class,'HistoriqueAssiduites'])->name('apprentis.HistoriqueAssiduites');
    Route::get('/apprentis/{id}/Historiqueevaluations',[ApprentisController::class,'Historiqueevaluations'])->name('apprentis.Historiqueevaluations');
    Route::get('/apprentis/{id}/Historiquepayements',[ApprentisController::class,'Historiquepayements'])->name('apprentis.Historiquepayements');
});
//specialites
Route::middleware('auth')->group(function(){
    Route::get('/specialites', [SpecialitesController::class, 'index'])->name('specialites.index');
    Route::post('/specialites', [SpecialitesController::class, 'store'])->name('specialites.store');
    Route::put('/specialites/{id}', [SpecialitesController::class, 'update'])->name('specialites.update');
    Route::delete('/specialites/{id}', [SpecialitesController::class, 'destroy'])->name('specialites.destroy'); 
});
//pvs
Route::middleware('auth')->group(function(){
    Route::get('/apprentis/pvinstallations/fiche', [FicheController::class, 'pv'])->name('pvinstallations.download'); 
});
//Dossiers 
Route::middleware('auth')->group(function(){
    Route::get('/apprentis/dossiers', [DossiersController::class, 'index'])->name('dossiers.index');
    Route::post('/apprentis/dossiers', [DossiersController::class, 'store'])->name('dossiers.store');
    Route::get('/apprentis/dossiers/consulter',[DossiersController::class,'consulter'])->name('dossiers.consulter');
    Route::get('/apprentis/fichiers/download/{id}', [DossiersController::class, 'pdfdownload'])->name('dossiers.pdfdownload');
    Route::post('/apprentis/fichiers/download/pv/{id}', [DossiersController::class, 'pv_pdfdownload'])->name('dossiers.pv_pdfdownload');
    Route::post('/apprentis/fichiers/download/decisiona/{id}', [DossiersController::class, 'decisiona_pdfdownload'])->name('dossiers.decisiona_pdfdownload');
    Route::post('/apprentis/fichiers/download/decisionma/{id}', [DossiersController::class, 'decisionma_pdfdownload'])->name('dossiers.decisionma_pdfdownload');
    Route::get('/apprentis/details/update/{id}', [DossiersController::class,'updateindex'])->name('dossiers.updateindex');
    Route::put('/apprentis/details/update/{id}', [DossiersController::class,'update'])->name('dossiers.update');
    Route::delete('/apprentis/details/update/{id}/{fichier}', [DossiersController::class, 'deletefichier'])->name('dossiers.deletefichier');
});
//Maitre Apprentis
Route::middleware('auth')->group(function(){
    Route::get('/maitreapprentis', [MaitreApprentisController::class, 'index'])->name('maitreapprentis.index');
    Route::post('/maitreapprentis', [MaitreApprentisController::class, 'submit'])->name('maitreapprentis.submit');
    Route::put('/maitreapprentis/{id}', [MaitreApprentisController::class, 'update'])->name('maitreapprentis.update');
    Route::delete('/maitreapprentis/{id}', [MaitreApprentisController::class, 'destroy'])->name('maitreapprentis.destroy');
});
//decisionsapprentis
Route::middleware('auth')->group(function(){
    Route::get('/decisions', [DecisionsController::class, 'index'])->name('decisions.index');
    Route::post('/decisions', [DecisionsController::class, 'store'])->name('decisions.store');
    Route::get('/decisions/ficheA', [FicheController::class, 'decisionA'])->name('decisions.ficheA');
    Route::get('/decisions/ficheMA', [FicheController::class, 'decisionMA'])->name('decisions.ficheMA'); 
});
// Evaluation maitre apprentis
Route::middleware('auth')->group(function(){
    Route::get('/evaluationMA', [EvaluationMaitreApprentisController::class, 'index'])->name('evaluationMA.index');
    Route::post('/evaluationMA', [EvaluationMaitreApprentisController::class, 'submit'])->name('evaluationMA.submit');
    Route::put('/evaluationMA/{id}', [EvaluationMaitreApprentisController::class, 'update'])->name('evaluationMA.update');
    Route::post('/evaluationMA/{id}', [EvaluationMaitreApprentisController::class, 'destroy'])->name('evaluationMA.destroy');
});
// Evaluation apprentis
Route::middleware('auth')->group(function(){
    Route::get('/apprentis/Evaluer', [EvaluationApprentisController::class, 'index'])->name('evaluation_apprentis.index');
    Route::post('/apprentis/Evaluer', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
    Route::put('/apprentis/Evaluer', [EvaluationApprentisController::class, 'submit'])->name('evaluation_apprentis.submit');
    Route::post('/apprentis/evaluer/generate-pdf', 'EvaluationApprentisController@fiche')->name('evaluation_apprentis.fiche');
});
//Assiduites
Route::middleware('auth')->group(function(){
    Route::get('/assiduites', [AssiduitesController::class, 'index'])->name('assiduites.index');
    Route::post('/assiduites', [AssiduitesController::class, 'submit'])->name('assiduites.submit');
    Route::put('/assiduites/{id}', [AssiduitesController::class, 'update'])->name('assiduites.update');
    Route::delete('/assiduites/{id}', [AssiduitesController::class, 'destroy'])->name('assiduites.destroy');
    Route::get('/download/{id}', [AssiduitesController::class, 'pdfdownload'])->name('dossiers.pdfdownload'); 
});
//plan besoins
Route::middleware('auth')->group(function(){
    Route::get('/planbesoins', [PlanBesoinsController::class, 'index'])->name('planbesoins.index');
    Route::post('/planbesoins', [PlanBesoinsController::class, 'store'])->name('planbesoins.store');
    Route::put('/planbesoins/{id}', [PlanBesoinsController::class, 'update'])->name('planbesoins.update');
    Route::delete('/planbesoins/{id}', [PlanBesoinsController::class, 'destroy'])->name('planbesoins.destroy');
});
//parametres
Route::middleware('auth')->group(function(){
    Route::get('/parametres', [ParametresController::class, 'index'])->name('parametres.index');
    Route::post('/parametres', [ParametresController::class, 'store'])->name('parametres.store');
    Route::put('/parametres/{id}', [ParametresController::class, 'update'])->name('parametres.update');
    Route::delete('/parametres/{id}', [ParametresController::class, 'destroy'])->name('parametres.destroy');
});
//exercices
Route::middleware('auth')->group(function(){
    Route::get('/exercices', [ExercicesController::class, 'index'])->name('exercices.index');
    Route::post('/exercices', [ExercicesController::class, 'store'])->name('exercices.store');
    Route::put('/exercices/{id}', [exercicesController::class, 'update'])->name('exercices.update');
    Route::delete('/exercices/{id}', [exercicesController::class, 'destroy'])->name('exercices.destroy');
});
//Baremes
Route::middleware('auth')->group(function(){
    Route::get('/baremes', [BaremesController::class, 'index'])->name('baremes.index');
    Route::post('/baremes', [BaremesController::class, 'store'])->name('baremes.store');
    Route::put('/baremes/{id}', [BaremesController::class, 'update'])->name('baremes.update');
    Route::delete('/baremes/{id}', [BaremesController::class, 'destroy'])->name('baremes.destroy');
});
//Departs
Route::middleware('auth')->group(function(){
    Route::get('/departs', [DepartsController::class, 'index'])->name('departs.index');
    Route::post('/departs', [DepartsController::class, 'store'])->name('departs.store');
    Route::put('/departs/{id}', [DepartsController::class, 'update'])->name('departs.update');
    Route::delete('/departs/{id}', [DepartsController::class, 'destroy'])->name('departs.destroy');
});
//Avenants
Route::middleware('auth')->group(function(){
    Route::get('/avenants', [AvenantsController::class, 'index'])->name('avenants.index');
    Route::post('/avenants', [AvenantsController::class, 'store'])->name('avenants.store');
    Route::put('/avenants/{id}', [AvenantsController::class, 'update'])->name('avenants.update');
    Route::delete('/avenants/{id}', [AvenantsController::class, 'destroy'])->name('avenants.destroy');
});
//refsalariaires
Route::middleware('auth')->group(function(){
    Route::get('/refsalariaires', [RefSalariairesController::class, 'index'])->name('refsalariaires.index');
    Route::post('/refsalariaires', [RefSalariairesController::class, 'store'])->name('refsalariaires.store');
    Route::put('/refsalariaires/{id}', [RefSalariairesController::class, 'update'])->name('refsalariaires.update');
    Route::delete('/refsalariaires/{id}', [RefSalariairesController::class, 'destroy'])->name('refsalariaires.destroy');
});
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

//DFP
Route::middleware('auth')->group(function () {
    Route::get('/dfp/dashboard',[DFPController::class,'index'])->name('dfp.dashboard');
});
//DRH
Route::middleware('auth')->group(function () {
    Route::get('/drh/dashboard',[DRHController::class,'index'])->name('drh.dashboard');
});
//SA
Route::middleware('auth')->group(function () {
    Route::get('/sa/dashboard',[SAsController::class,'index'])->name('sa.dashboard');
});
//EG
Route::middleware('auth')->group(function () {
    Route::get('/evaluateurgrade/dashboard',[EvaluateurGradeController::class,'index'])->name('evaluateurgrade.dashboard');
});
// Comptes
Route::middleware('auth')->group(function () {
    Route::get('/comptes',[ComptesController::class,'index'])->name('comptes.index');
    Route::post('/comptes',[ComptesController::class,'store'])->name('comptes.store');
    Route::delete('/comptes/{id}',[ComptesController::class,'destroy'])->name('comptes.destroy');
    Route::put('/comptes/{id}',[ComptesController::class,'update'])->name('comptes.update');
});
Route::middleware('auth')->group(function (){
    Route::get('/sidenav',[sidenavController::class,'index']);
});