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
            'nom.required' => 'The name field is required.',
            'prenom.required' => 'The surname field is required.',
            'civilite.required' => 'The gender field is required.',
            'nationalite.required' => 'The nationality field is required.',
            'email.required' => 'The email field is required.',
            'telephone.required' => 'The telephone field is required.',
            'adresse.required' => 'The address field is required.',
            'niveauscolaire.required' => 'The level of study field is required.',
            'specialite.required' => 'The specialty field is required.',
            'datenaissance.required' => 'required',
            'diplomes_id.required' => '',
            'status.required' => 'The status field is required.',
            'email.email' => 'The email must be a valid email address.',
            'telephone.numeric' => 'The telephone must be a valid number.',
            'maitre_apprenti.required' => 'Please select a master apprentice.',
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
            $apprenti->fill($request->all());
            $apprenti->save();
            
            // Find the master apprentice based on the selected ID and update the apprentice_id field
            $maitreApprenti = maitre_apprentis::find($request->maitre_apprenti);
            $maitreApprenti->apprentis_id = $apprenti->id; // Use the newly created apprentice's ID
            $maitreApprenti->save();
            
            return redirect('/')->with('success', 'Apprenti ajouté avec succès');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }
}
