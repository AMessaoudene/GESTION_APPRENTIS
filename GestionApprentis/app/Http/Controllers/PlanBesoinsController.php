<?php

namespace App\Http\Controllers;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\structures;
use App\Models\exercices;
use Illuminate\Support\Facades\Storage;
use App\Models\specialites;
use App\Models\PlanBesoins;
use Illuminate\Http\Request;
use Auth;

class PlanBesoinsController extends Controller
{
    public function index()
    {
        if(Auth::user()->status == 'active'){
            $user = Auth::user();
            $planbesoins = PlanBesoins::all();
            $specialites = specialites::all();
            $structures = structures::all();
            $exercices = exercices::all();
            return view('planbesoins.index', compact('planbesoins','structures','exercices','specialites','user'));
        }
        else{
            return redirect()->back()->with('no access');
        }
    }
    public function store(Request $request){
        $specialitesIds = $request->specialites_id;
        $nombereffectif = $request->nombereffectif; // Single nombereffectif value
        $nombreapprentismax = $nombereffectif * 0.05;
    
        $planbesoinsArray = [];
        foreach ($specialitesIds as $key => $specialiteId) {
            $planbesoins = new PlanBesoins();
            $planbesoins->exercice_id = $request->exercice_id;
            $planbesoins->reference = $request->reference;
            $planbesoins->structure_id = $request->structure_id;
            $planbesoins->date = $request->date;
            $planbesoins->specialites_id = $specialiteId;
            $planbesoins->nombreapprentis = $request->nombreapprentis[$key];
            $planbesoins->nombereffectif = $nombereffectif; // Use single nombereffectif value
            $planbesoins->nombreapprentismax = $nombreapprentismax; // Use calculated max value
            $planbesoins->description = $request->description[$key];
            $planbesoins->status = "en cours";
            $planbesoins->save();
            
            $planbesoinsArray[] = $planbesoins;
        }    
        return redirect()->back()->with('success', 'Plan de besoins ajouté avec succès');
    }
    

    public function update(Request $request, $id)
    {
        $planbesoins = PlanBesoins::findOrFail($id);
        $planbesoins->exercice_id = $request->exercice_id;
        $planbesoins->reference = $request->reference;
        $planbesoins->structure_id = $request->structure_id;
        $planbesoins->date = $request->date;
        $planbesoins->nombreapprentis = $request->nombreapprentis;
        $planbesoins->nombereffectif = $request->nombereffectif;
        $planbesoins->nombreapprentismax = $request->nombereffectif * 0.05;
        $planbesoins->description = $request->description;
        $planbesoins->status = $request->status;
        $planbesoins->save();
        return redirect()->back();
    }
    public function destroy($id) {
        // Set planbesoins_id to null for related records in decisionapprentis and decisionmaitreapprentis
        decisionapprentis::where('planbesoins_id', $id)->update(['planbesoins_id' => null]);
        decisionmaitreapprentis::where('planbesoins_id', $id)->update(['planbesoins_id' => null]);
    
        // Delete the PlanBesoins record
        PlanBesoins::destroy($id);
    
        return redirect()->back();
    }    
}
