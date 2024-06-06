<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use App\Models\planbesoins;
use App\Models\structures;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class StructuresController extends Controller
{
    public function index() {
        $structures = structures::all();
        $users = User::all();
        $user = Auth::user();
        return view('structures.index', compact('structures','users','user'));
    }
    //Ajout d'une structure
    public function submit(Request $request) {
        $rules = [
            'nom' => 'required',
            'adressecourriel' => 'required',
        ];
        $messages = [
            'nom.required' => 'Le nom est obligatoire',
            'adressecourriel.required' => 'Le courriel est obligatoire',
        ];

        $validate=Validator::make($request->all(), $rules, $messages);
        
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            $structure = new structures();
            $structure->nom = $request->nom;
            $structure->adresseCourriel = $request->adressecourriel;
            $structure->save();
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        $structure = structures::findOrFail($id);
        $structure->nom = $request->nom;
        $structure->adresseCourriel = $request->adressecourriel;
        $structure->save();
        return redirect()->back();
    }

    public function destroy($id){
        // Retrieve and update each apprenti associated with the structure
        $apprentis = apprentis::where('structure_id', $id)->get();
        foreach ($apprentis as $apprenti) {
            $apprenti->structure_id = null;
            $apprenti->save();
        }

        // Retrieve and update each maitre apprenti associated with the structure
        $maitre = maitre_apprentis::where('structures_id', $id)->get();
        foreach ($maitre as $maitre_apprenti) {
            $maitre_apprenti->structures_id = null;
            $maitre_apprenti->save();
        }

        planbesoins::where('structure_id',$id)->update(['structure_id' => null]);
        User::where('structures_id',$id)->update(['structures_id' => null]);

        // Destroy the structure
        structures::destroy($id);

        return redirect()->back();
    }

}
