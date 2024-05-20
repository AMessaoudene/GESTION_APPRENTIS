<?php

namespace App\Http\Controllers;
use App\Models\maitre_apprentis;
use App\Models\evaluation_maitre_apprentis;
use Illuminate\Http\Request;

class EvaluationMaitreApprentisController extends Controller
{
    public function index()
    {
        $maitreapprentis = maitre_apprentis::all();
        return view('evaluation_maitre_apprentis.index',compact('maitreapprentis'));
    }
    
    public function submit(Request $request)
    {
        $evaluationmaitreapprentis = new evaluation_maitre_apprentis();
        $evaluationmaitreapprentis->reference = $request->reference;
        $evaluationmaitreapprentis->maitreapprenti_id = $request->maitreapprenti_id;
        $evaluationmaitreapprentis->datedebut = $request->datedebut;
        $evaluationmaitreapprentis->datefin = $request->datefin;
        $evaluationmaitreapprentis->sensresponsabilite = $request->sensresponsabilite ;
        $evaluationmaitreapprentis->observationsr = $request->observationsr ;
        $evaluationmaitreapprentis->disponibiliteorientationapprenti = $request->disponibiliteorientationapprenti ;
        $evaluationmaitreapprentis->observationdoa = $request->observationdoa ;
        $evaluationmaitreapprentis->respectmissionencadrement = $request->respectmissionencadrement ;
        $evaluationmaitreapprentis->observationrme = $request->observationrme ;
        $evaluationmaitreapprentis->effetpoursuiviapprenti = $request->effetpoursuiviapprenti ;
        $evaluationmaitreapprentis->observationepsa = $request->observationepsa ;
        $evaluationmaitreapprentis->qualiteencadrementapprenti = $request->qualiteencadrementapprenti ;
        $evaluationmaitreapprentis->observationqea = $request->observationqea ;
        $evaluationmaitreapprentis->avisapprenti = $request->avisapprenti ;
        $evaluationmaitreapprentis->save();
        return redirect()->back()->with('success');
    }

 
    public function show($id)
    {
        //
    }

}
