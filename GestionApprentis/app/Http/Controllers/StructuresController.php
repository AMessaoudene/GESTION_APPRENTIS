<?php

namespace App\Http\Controllers;
use App\Models\structures;
use Illuminate\Http\Request;
use Validator;

class StructuresController extends Controller
{
    public function index() {
        return view('structures.ajouter');
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
}
