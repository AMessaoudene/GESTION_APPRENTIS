<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\assiduites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
class AssiduitesController extends Controller{
    public function index()
    {
        $apprentis = apprentis::all();
        $assiduites = assiduites::all();
        return view('assiduites.index', compact('apprentis', 'assiduites'));
    }
    public function submit(Request $request)
    {
        $rules = [
            'apprenti_id' => 'required',
            'type' => 'required',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'motif' => 'required|string|max:255',
            'preuve' => 'required|file|max:10240',
        ];

        $messages = [
            'apprenti_id.required' => 'Le champ apprenti est obligatoire.',
            'type.required' => 'Le champ type est obligatoire.',
            'datedebut.required' => 'Le champ datedebut est obligatoire.',
            'datefin.required' => 'Le champ datefin est obligatoire.',
            'motif.required' => 'Le champ motif est obligatoire.',
            'preuve.required' => 'Le champ preuve est obligatoire.',
            'preuve.file' => 'Le champ preuve doit être un fichier.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
                $assiduites = new assiduites();
                $assiduites->apprenti_id = $request->apprenti_id; // Correct property name
                $assiduites->type = $request->type;
                $assiduites->datedebut = $request->datedebut;
                $assiduites->datefin = $request->datefin;
                $assiduites->motif = $request->motif;
                $preuve = $request->file('preuve');
                $preuvenom = 'preuve'.time().'.'.$preuve->getClientOriginalExtension();
                $preuve->move('assets/preuves', $preuvenom);
                $assiduites->preuve = $preuvenom;
                $assiduites->save();
                return redirect()->back()->with('success', 'Assiduité ajoutée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function update(Request $request, $id)
    {
        $assiduites = assiduites::findOrFail($id);
        $assiduites->apprenti_id = $request->apprenti_id; // Correct property name
        $assiduites->type = $request->type;
        $assiduites->datedebut = $request->datedebut;
        $assiduites->datefin = $request->datefin;
        $assiduites->motif = $request->motif;
        $preuve = $request->file('preuve');
        $preuvenom = 'preuve-'.time().'.'.$preuve->getClientOriginalExtension();
        $preuve->move('assets/preuves', $preuvenom);
        $assiduites->preuve = $preuvenom;
        $assiduites->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        assiduites::destroy($id);

        return response()->json(['success' => true]); // Return success response
    }
}