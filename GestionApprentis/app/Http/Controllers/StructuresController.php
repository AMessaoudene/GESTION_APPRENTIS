<?php

namespace App\Http\Controllers;
use App\Models\structures;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\JsonResponse;

class StructuresController extends Controller
{
    public function index() {
        $structures = structures::all();
        return view('structures.index', compact('structures'));
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
        return new JsonResponse(['success' => true]);
    }

    public function destroy($id)
    {
        structures::destroy($id);
        return new JsonResponse(['success' => true]);
    }
}
