<?php

namespace App\Http\Controllers;
use App\Models\maitre_apprentis;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaitreApprentisController extends Controller
{
    public function index()
    {
        $maitre_apprentis = maitre_apprentis::all();
        if(auth::user()->role === 'DFP'){
            return view('maitre_apprentis.index', compact('maitre_apprentis'));
        }
        else{
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
    }

    public function submit(Request $request)
    {
        // Validation rules
        $rules = [
            'matricule' => 'required',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'civilite' => 'required',
            'email' => 'required|email|max:255',
            'telephonepro' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'daterecrutement' => 'required|date|max:255',
        ];

        // Custom error messages
        $messages = [
            'matricule.required' => 'Le matricule est obligatoire.',
            'nom.required' => 'The name field is required.',
            'prenom.required' => 'The surname field is required.',
            'civilite.required' => 'The gender field is required.',
            'email.required' => 'The email field is required.',
            'telephonepro.required' => 'The telephone field is required.',
            'adresse.required' => 'The address field is required.',
            'fonction.required' => 'The work function field is required.',
            'daterecrutement.required' => 'The recruitment date field is required.',
            'daterecrutement.date' => 'The recruitment date must be a valid date.',            
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $maitre_apprentis = new maitre_apprentis;
            $maitre_apprentis->matricule = $request->matricule;
            $maitre_apprentis->nom = $request->nom;
            $maitre_apprentis->prenom = $request->prenom;
            $maitre_apprentis->civilite = $request->civilite;
            $maitre_apprentis->email = $request->email;
            $maitre_apprentis->telephonepro = $request->telephonepro;
            $maitre_apprentis->adresse = $request->adresse;
            $maitre_apprentis->fonction = $request->fonction;
            $maitre_apprentis->numapprentissupervises = 0;
            $maitre_apprentis->daterecrutement = $request->daterecrutement;
            $maitre_apprentis->affectation = $request->affectation;
            $maitre_apprentis->statut = $request->statut;
            $maitre_apprentis->save();
            return redirect()->back()->with('success', 'Maitre d\'apprentissage ajoute avec succes');
        }
    }
    public function update(Request $request,$id){
        $maitre_apprentis = maitre_apprentis::find($id);
        $maitre_apprentis->matricule = $request->matricule;
        $maitre_apprentis->nom = $request->nom;
        $maitre_apprentis->prenom = $request->prenom;
        $maitre_apprentis->civilite = $request->civilite;
        $maitre_apprentis->email = $request->email;
        $maitre_apprentis->telephonepro = $request->telephonepro;
        $maitre_apprentis->adresse = $request->adresse;
        $maitre_apprentis->fonction = $request->fonction;
        $maitre_apprentis->daterecrutement = $request->daterecrutement;
        $maitre_apprentis->affectation = $request->affectation;
        $maitre_apprentis->statut = $request->statut;
        $maitre_apprentis->save();
        return redirect()->back()->with('success', 'Maitre d\'apprentissage modifie avec succes');
    }
}
