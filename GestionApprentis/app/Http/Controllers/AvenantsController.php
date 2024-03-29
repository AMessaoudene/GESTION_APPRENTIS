<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\apprentis;
use App\Models\assiduites;
use Illuminate\Http\Request;

class AvenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apprentis = apprentis::all();
        return view('assiduites.ajouter', compact('apprentis'));
    }
    public function store(Request $request)
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
                $preuvePath = $request->file('preuve')->store('public/uploads'); // Store the file and get its path
                $assiduites = new assiduites();
                $assiduites->apprenti_id = $request->apprenti_id; // Correct property name
                $assiduites->type = $request->type;
                $assiduites->datedebut = $request->datedebut;
                $assiduites->datefin = $request->datefin;
                $assiduites->motif = $request->motif;
                $assiduites->preuve = $preuvePath; // Save the file path
                $assiduites->save();
                return redirect()->back()->with('success', 'Assiduité ajoutée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function show(Request $request)
    {
        // Retrieve all "assiduites" associated with the selected apprentice
        $assiduites = assiduites::all();

        return view('assiduites.consulter', compact('assiduites'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /* Validate input fields */
        $rules = [
            'decisionapprenti_id' => 'required',
            'type' => 'required',
            'date' => 'required|date',
        ];

        $messages = [
            'decisionapprenti_id.required' => 'Le champ decisionapprenti_id est obligatoire.',
            'type.required' => 'Le champ type est obligatoire.',
            'date.required' => 'Le champ date est obligatoire.',
        ];

        $validator =Validator ::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else{
            $assiduites = assiduites::find($id);
            $assiduites->decisionapprenti_id = $request->decisionapprenti_id;
            $assiduites->type = $request->type;
            $assiduites->date = $request->date;
            $assiduites->save();
            return redirect()->back()->with('success', 'Assiduité modifié avec succès!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $assiduites = assiduites::find($id);
            $assiduites->delete();
            return redirect()->back()->with('success', 'Assiduité supprimée avec succès!');
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
