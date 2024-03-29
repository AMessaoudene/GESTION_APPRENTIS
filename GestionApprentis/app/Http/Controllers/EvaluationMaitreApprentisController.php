<?php

namespace App\Http\Controllers;
use App\Models\maitre_apprentis;
use APP\Models\evaluation_maitre_apprentis;
use Illuminate\Http\Request;

class EvaluationMaitreApprentisController extends Controller
{
    public function index()
    {
        $maitre_apprentis = maitre_apprentis::all();
        return view('evaluation_maitre_apprentis.ajouter',compact('maitre_apprentis'));
    }
    
    public function store(Request $request)
    {
        $evaluationmaitreapprentis = new evaluation_maitre_apprentis();
        $evaluationmaitreapprentis->reference = $request->reference;
        $evaluationmaitreapprentis->maitreapprentis_id = $request->maitreapprentis_id;
        $evaluationmaitreapprentis->save();
        return redirect()->route('evaluation_maitre_apprentis.index');
    }

 
    public function show($id)
    {
        //
    }

}
