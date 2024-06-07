<?php

namespace App\Http\Controllers;
use App\Models\exercices;
use App\Models\planbesoins;
use Illuminate\Http\Request;
use Auth;
class ExercicesController extends Controller
{
    public function index()
    {
        if(Auth::user()->status == 'active'){
            $user = auth::user();
            $exercices = exercices::all();
            return view('exercices.index', compact('exercices','user'));
        }
        else{
            return redirect()->back()->with('no access');
        }
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
        exercices::where('status', 'actif')->update(['status' => 'inactif']);
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
        return redirect()->back();
    }

    public function destroy($id)
    {
        planbesoins::where('exercice_id',$id)->update(['exercice_id' => null]);
        $exercice = exercices::findOrFail($id);
        $exercice->delete();
        return redirect()->back();
    }
}
