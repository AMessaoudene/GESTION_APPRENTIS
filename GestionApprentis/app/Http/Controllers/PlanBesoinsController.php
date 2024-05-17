<?php

namespace App\Http\Controllers;
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
        $user = Auth::user();
        $planbesoins = PlanBesoins::all();
        $specialites = specialites::all();
        $structures = structures::all();
        $exercices = exercices::all();
        return view('planbesoins.index', compact('planbesoins','structures','exercices','specialites','user'));
    }
    public function store(Request $request)
{
    $specialitesIds = $request->specialites_id;
    $nombreEffectifs = $request->nombereffectif;
    
    // Assuming that $specialitesIds and $nombreEffectifs have the same length
    $planbesoinsArray = [];
    foreach ($specialitesIds as $key => $specialiteId) {
        $planbesoins = new PlanBesoins();
        $planbesoins->exercice_id = $request->exercice_id;
        $planbesoins->reference = $request->reference;
        $planbesoins->structure_id = $request->structure_id;
        $planbesoins->date = $request->date;
        $planbesoins->specialites_id = $specialiteId;
        $planbesoins->nombreapprentis = $request->nombreapprentis[$key];
        $planbesoins->nombereffectif = $nombreEffectifs[$key];
        $planbesoins->nombreapprentismax = $nombreEffectifs[$key] * 0.05;
        $planbesoins->description = $request->description[$key];
        $planbesoins->status = "en cours";
        $planbesoins->save();
        
        $planbesoinsArray[] = $planbesoins;
    }    
    return redirect()->back()->with('success');
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
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        PlanBesoins::destroy($id);
        return response()->json(['success' => true]);
    }
}
