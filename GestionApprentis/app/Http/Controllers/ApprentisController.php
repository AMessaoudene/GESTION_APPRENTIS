<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\structures;
use App\Models\specialites;
use Validator;

class ApprentisController extends Controller
{
    public function index()
    {
        $diplomes = diplomes::all();
        $maitre_apprentis = maitre_apprentis::all();
        $structures = structures::all();
        $specialites = specialites::all();
        return view('apprentis.index', compact('maitre_apprentis','diplomes','structures','specialites')); 
    }

    public function submit(Request $request){
        // Validation rules
        $rules = [
            'numcontrat' => 'required|string|max:255',
            'datecontrat' => 'required|date|max:255',
            'datedebut' => 'required|date|max:255',
            'datefin' => 'required|date|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'civilite' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'datenaissance' => 'required|date|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'niveauscolaire' => 'required|string|max:255',
            'specialite_id' => 'required|string|max:255',
            'structure_id' => 'required|string|max:255',
            'diplome1_id' => 'required|string|max:255',
            'status' => 'required',
            /*'maitre_apprentis' => 'required|string|max:255',*/
        ];

        // Custom error messages
        $messages = [
            /*'numcontrat.required' => 'Le champ numéro de contrat est requis.',
            'datecontrat.required' => 'Le champ date de contrat est requis.',
            'datedebut.required' => 'Le champ date de debut est requis.',
            'datefin.required' => 'Le champ date de fin est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',*/
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // Create a new apprentice record
            $apprenti = new apprentis();
            $apprenti->numcontrat = $request->numcontrat;
            $apprenti->datecontrat = $request->datecontrat;
            $apprenti->datedebut = $request->datedebut;
            $apprenti->datefin = $request->datefin;
            $apprenti->nom = $request->nom;
            $apprenti->prenom = $request->prenom;
            $apprenti->civilite = $request->civilite;
            $apprenti->nationalite = $request->nationalite;
            $apprenti->datenaissance = $request->datenaissance;
            $apprenti->email = $request->email;
            $apprenti->telephone = $request->telephone;
            $apprenti->adresse = $request->adresse;
            $apprenti->niveauscolaire = $request->niveauscolaire;
            $apprenti->specialite_id = $request->specialite_id;
            $apprenti->structure_id = $request->structure_id;
            $apprenti->diplome1_id = $request->diplome1_id;
            $apprenti->status = $request->status;
            $apprenti->save();
            
            // Find the master apprentice based on the selected ID
            $maitreApprenti = maitre_apprentis::find($request->maitre_apprentis);
            
            // Check if apprenti1_id is null, then assign to apprenti1_id
            if (is_null($maitreApprenti->apprenti1_id)) {
                $maitreApprenti->apprenti1_id = $apprenti->id;
            } else if(is_null($maitreApprenti->apprenti2_id)) {
                // If apprenti1_id is not null, assign to apprenti2_id
                $maitreApprenti->apprenti2_id = $apprenti->id;
            }

            // Save the updated master apprentice
            $maitreApprenti->save();
            Session::put('apprenti', $apprenti);
            return redirect()->route('pvinstallations.index');
            } catch (\Exception $e) {
                return redirect('/')->with('error', 'Une erreur est survenue: ' . $e->getMessage());
            }
    }
    public function edit($id)
    {  
        try {
            $apprenti = apprentis::find($id);
            $maitre_apprentis = maitre_apprentis::all();
            $diplomes = diplomes::all();
            return view('apprentis.modifier', compact('apprenti', 'maitre_apprentis','diplomes'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        } 
        
    }
    public function show()
    {
        $apprentis = apprentis::all();
        return view('apprentis.afficher', compact('apprentis'));
    }
    public function destroy($id)
    {
        $apprenti = apprentis::find($id);
        $apprenti->delete();
        return redirect('/')->with('success', 'Apprenti supprimé avec succès');
    }
}
