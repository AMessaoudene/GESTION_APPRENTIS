<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use Validator;

class ApprentisController extends Controller
{
    public function index()
    {
        $diplomes = diplomes::all();
        $maitre_apprentis = maitre_apprentis::all();
        return view('apprentis.ajouter', compact('maitre_apprentis','diplomes')); 
    }

    public function submit(Request $request)
    {
        // Validation rules
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'civilite' => 'required',
            'nationalite' => 'required',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'niveauscolaire' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'datenaissance' => 'required|date',
            'diplomes_id' => 'required',
            'status' => 'required|string|max:255',
            'maitre_apprenti' => 'required', // Ensure maitre_apprenti field is required
        ];

        // Custom error messages
        $messages = [
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'civilite.required' => 'Le champ civilité est requis.',
            'nationalite.required' => 'Le champ nationalité est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'telephone.required' => 'Le champ téléphone est requis.',
            'telephone.numeric' => 'Le téléphone doit être un numéro valide.',
            'adresse.required' => 'Le champ adresse est requis.',
            'niveauscolaire.required' => 'Le champ niveau scolaire est requis.',
            'specialite.required' => 'Le champ spécialité est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',
            'diplomes_id.required' => 'Le champ diplôme est requis.',
            'status.required' => 'Le champ statut est requis.',
            'maitre_apprenti.required' => 'Veuillez sélectionner un maître d\'apprentis.',
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, store the data
        try {
            // Create a new apprentice record
            $apprenti = new apprentis();
            $apprenti->nom = $request->nom;
            $apprenti->prenom = $request->prenom;
            $apprenti->civilite = $request->civilite;
            $apprenti->nationalite = $request->nationalite;
            $apprenti->datenaissance = $request->datenaissance;
            $apprenti->email = $request->email;
            $apprenti->telephone = $request->telephone;
            $apprenti->adresse = $request->adresse;
            $apprenti->niveauscolaire = $request->niveauscolaire;
            $apprenti->specialite = $request->specialite;
            $apprenti->diplomes_id = $request->diplomes_id;
            $apprenti->maitre_apprentis->$request->maitre_apprentis;
            $apprenti->status = $request->status;
            $apprenti->save();
            
            // Find the master apprentice based on the selected ID and update the apprentice_id field
            $maitreApprenti = maitre_apprentis::find($request->maitre_apprenti);
            if($maitreApprenti->apprenti1_id==null){
                $maitreApprenti->apprenti1_id = $apprenti->id;
            }else if($maitreApprenti->apprenti2_id==null){
                $maitreApprenti->apprenti2_id = $apprenti->id;
            }else{
                return redirect('/')->with('error', 'Le maitre d\'apprenti est déjà indisponible');
            }
            $maitreApprenti->save();
            
            return redirect('/')->with('success', 'Apprenti ajouté avec succès');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }
}
