<?php

namespace App\Http\Controllers;
use App\Models\structures;
use App\Models\exercices;
use Illuminate\Support\Facades\Storage;
use App\Models\specialites;
use App\Models\PlanBesoins;
use Illuminate\Http\Request;

class PlanBesoinsController extends Controller
{
    public function index()
    {
        $planbesoins = PlanBesoins::all();
        $specialites = specialites::all();
        $structures = structures::all();
        $exercices = exercices::all();
        return view('planbesoins.index', compact('planbesoins','structures','exercices','specialites'));
    }
    public function store(Request $request)
    {
        $planbesoins = new PlanBesoins();
        $planbesoins->exercice_id = $request->exercice_id;
        $planbesoins->reference = $request->reference;
        $planbesoins->structure_id = $request->structure_id;
        $planbesoins->date = $request->date;
        $planbesoins->specialites_id = $request->specialites_id;
        $planbesoins->nombreapprentis = $request->nombreapprentis;
        $planbesoins->nombereffectif = $request->nombereffectif;
        $planbesoins->nombreapprentismax = $request->nombereffectif * 0.05;
        $planbesoins->description = $request->description;
        $planbesoins->status = "en cours";
        $planbesoins->save();
        return redirect('/planbesoins');
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
