<?php

namespace App\Http\Controllers;
use App\Models\exercices;
use Illuminate\Http\Request;

class ExercicesController extends Controller
{
    public function index()
    {
        return view('exercices.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'nombrebesoins' => 'required|integer',
            'massesalariaire' => 'required|integer',
        ]);
        $exercice = new exercices();
        $exercice->annee = $request->annee;
        $exercice->datedebut = $request->datedebut;
        $exercice->datefin = $request->datefin;
        $exercice->nombrebesoins = $request->nombrebesoins;
        $exercice->massesalariaire = $request->massesalariaire;
        $exercice->budget = $request->massesalariaire * 0.01;
        $exercice->save();
        return redirect()->route('exercices.index')->with('success', 'Exercice created successfully');
    }
}
