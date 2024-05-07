<?php

namespace App\Http\Controllers;
use App\Models\exercices;
use Illuminate\Http\Request;
use Auth;
class ExercicesController extends Controller
{
    public function index()
    {
        $user = auth::user();
        $exercices = exercices::all();
        return view('exercices.index', compact('exercices','user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'nombrebesoins' => 'required|integer',
            'massesalariaire' => 'required',
        ]);
        $exercice = new exercices();
        $exercice->annee = $request->annee;
        $exercice->datedebut = $request->datedebut;
        $exercice->datefin = $request->datefin;
        $exercice->nombrebesoins = $request->nombrebesoins;
        $exercice->massesalariaire = $request->massesalariaire;
        $exercice->budget = $request->massesalariaire * 0.01;
        $exercice->status = 'actif';
        $exercice->save();
        return redirect()->route('exercices.index')->with('success', 'Exercice created successfully');
    }
    public function update(Request $request, $id)
    {
        $exercice = exercices::findOrFail($id);
        $exercice->annee = $request->annee;
        $exercice->datedebut = $request->datedebut;
        $exercice->datefin = $request->datefin;
        $exercice->nombrebesoins = $request->nombrebesoins;
        $exercice->massesalariaire = $request->massesalariaire;
        $exercice->budget = $request->massesalariaire * 0.01;
        $exercice->status = $request->status;
        $exercice->save();
        return response()->json(['success' => true]);
    }
}
