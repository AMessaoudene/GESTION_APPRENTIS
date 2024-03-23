<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\assiduites;
use Illuminate\Http\Request;
use Validator;
class AssiduitesController extends Controller
{
    public function index()
    {
        $apprentis = apprentis::all();
        return view('assiduites.ajouter', compact('apprentis'));
    }
    public function submit(Request $request)
    {
        $rules=[
            'apprentis_id' => 'required',
            'datedebut'=>'required|date',
            'datefin'=>'required|date',
            'statut'=>'required',
            'motif' => 'required|string|max:255',
            'preuve' => 'required|',
        ];
        $messages = [
            'apprentis_id.required' => 'Le champ apprentis_id est obligatoire.',
            'datedebut.required' => 'Le champ datedebut est obligatoire.',
            'datedebut.date' => 'Le champ datedebut doit être une date valide.',
            'datefin.required' => 'Le champ datefin est obligatoire.',
            'datefin.date' => 'Le champ datefin doit être une date valide.',
            'statut.required' => 'Le champ statut est obligatoire.',
            'motif.required' => 'Le champ motif est obligatoire.',
            'motif.max' => 'Le motif ne doit pas dépasser 255 caractères.',
            'preuve.required' => 'Le champ preuve est obligatoire.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            try{
                $assiduites = new assiduites();
                $assiduites->apprentis_id = $request->apprentis_id;
                $assiduites->datedebut = $request->datedebut;
                $assiduites->datefin = $request->datefin;
                $assiduites->statut = $request->statut;
                $assiduites->motif = $request->motif;
                $assiduites->preuve = $request->preuve;
                $assiduites->save();
                return redirect()->route('assiduites.index');
            } catch (\Exception $e){
                return redirect()->back()->withErrors($e)->withInput();
            }
        }
    }
}
