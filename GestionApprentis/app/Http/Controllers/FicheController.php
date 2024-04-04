<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\structures;
use App\Models\apprentis;
use App\Models\parametres;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pv()
    {
        $pv = Session::get('pv');
        $apprenti = Session::get('apprenti');
        $maitre_apprenti1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
        $maitre_apprenti2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
        (!is_null($maitre_apprenti1)) ? $maitre_apprentis = $maitre_apprenti1 : $maitre_apprentis = $maitre_apprenti2;
        $maitre_apprenti = maitre_apprentis::findOrFail($maitre_apprentis->id);
        //$diplomeMA = $maitre_apprenti->diplome_id;
        //$diplome = diplomes::findOrFail($diplomeMA);
        return view('pvinstallations.fiche',['pv' => $pv, 'apprenti' => $apprenti, 'maitre_apprenti' => $maitre_apprenti]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function decisionA()
    {
        $pv = Session::get('pv');
        $parametres = parametres::all();
        return view('decisions.ficheA', compact('pv', 'parametres'));
    }

    public function decisionMA(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
