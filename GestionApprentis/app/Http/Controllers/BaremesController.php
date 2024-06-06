<?php

namespace App\Http\Controllers;
use App\Models\baremes;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\refsalariares;
use App\Models\diplomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaremesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $baremes = baremes::all();
        $refsalaries = refsalariares::all();
        $diplomes = diplomes::all();
        if(auth::user()){
            return view('baremes.index', compact('baremes', 'refsalaries', 'diplomes'));
        }
        else{
            return redirect()->back()->with('error', 'You do not have the required role to access this page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        baremes::where('statut', 'actif')->where('diplome_id', $request->diplome_id)->update(['statut' => 'inactif']);
        $referencesalariaires = refsalariares::find($request->refsalariaires_id);
        $baremes = new baremes();
        $baremes->refsalariaires_id = $request->refsalariaires_id;
        $baremes->diplome_id = $request->diplome_id;
        $baremes->tauxs1_apprentis = $request->tauxs1_apprentis;
        $baremes->montantchiffres1_apprentis = ($request->tauxs1_apprentis * $referencesalariaires->snmg)/100;
        $baremes->montantlettres1_apprentis = $request->montantlettres1_apprentis;
        $baremes->tauxs2_apprentis = $request->tauxs2_apprentis;
        $baremes->montantchiffres2_apprentis = ($request->tauxs2_apprentis * $referencesalariaires->snmg)/100;
        $baremes->montantlettres2_apprentis = $request->montantlettres2_apprentis;
        $baremes->tauxs3_apprentis = $request->tauxs3_apprentis;
        $baremes->montantchiffres3_apprentis = ($request->tauxs3_apprentis * $referencesalariaires->snmg)/100;
        $baremes->montantlettres3_apprentis = $request->montantlettres3_apprentis;
        $baremes->tauxs4_apprentis = $request->tauxs4_apprentis;
        $baremes->montantchiffres4_apprentis = ($request->tauxs4_apprentis * $referencesalariaires->snmg)/100;
        $baremes->montantlettres4_apprentis = $request->montantlettres4_apprentis;
        $baremes->tauxs5_apprentis = $request->tauxs5_apprentis;
        $baremes->montantchiffres5_apprentis = ($request->tauxs5_apprentis * $referencesalariaires->snmg)/100;
        $baremes->montantlettres5_apprentis = $request->montantlettres5_apprentis;
        $baremes->tauxs1_maitreapprentis = $request->tauxs1_maitreapprentis;
        $baremes->montantchiffres1_maitreapprentis = ($request->tauxs1_maitreapprentis * $referencesalariaires->salairereference)/100;
        $baremes->montantlettres1_maitreapprentis = $request->montantlettres1_maitreapprentis;
        $baremes->tauxs2_maitreapprentis = $request->tauxs2_maitreapprentis;
        $baremes->montantchiffres2_maitreapprentis = ($request->tauxs2_maitreapprentis * $referencesalariaires->salairereference)/100;
        $baremes->montantlettres2_maitreapprentis = $request->montantlettres2_maitreapprentis;
        $baremes->tauxs3_maitreapprentis = $request->tauxs3_maitreapprentis;
        $baremes->montantchiffres3_maitreapprentis = ($request->tauxs3_maitreapprentis * $referencesalariaires->salairereference)/100;
        $baremes->montantlettres3_maitreapprentis = $request->montantlettres3_maitreapprentis;
        $baremes->tauxs4_maitreapprentis = $request->tauxs4_maitreapprentis;
        $baremes->montantchiffres4_maitreapprentis = ($request->tauxs4_maitreapprentis * $referencesalariaires->salairereference)/100;
        $baremes->montantlettres4_maitreapprentis = $request->montantlettres4_maitreapprentis;
        $baremes->tauxs5_maitreapprentis = $request->tauxs5_maitreapprentis;
        $baremes->montantchiffres5_maitreapprentis = ($request->tauxs5_maitreapprentis * $referencesalariaires->salairereference)/100;
        $baremes->montantlettres5_maitreapprentis = $request->montantlettres5_maitreapprentis;
        $baremes->statut = "actif";
        $baremes->save();
        return redirect()->route('baremes.index')->with('success', 'Bareme ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        decisionapprentis::where('bareme_id',$id)->update(['bareme_id' => null]);
        decisionmaitreapprentis::where('bareme_id',$id)->update(['bareme_id' => null]);
        baremes::destroy($id);
        return redirect()->back();
    }
}
