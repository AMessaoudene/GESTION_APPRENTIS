<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\diplomes;
use App\Models\maitre_apprentis;
use App\Models\pv_installations;
use App\Models\specialites;
use App\Models\structures;
use App\Models\decisionmaitreapprentis;
use App\Models\baremes;
use App\Models\refsalariares;
use App\Models\supervisions;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaitreApprentisController extends Controller
{
    public function index()
    {
        if(auth::user()->status == "active"){
            $maitre_apprentis = maitre_apprentis::all();
            $structures = structures::all();
            $specialites = specialites::all();
            $diplomes = diplomes::all();
            return view('maitre_apprentis.index', compact('diplomes','maitre_apprentis','structures','specialites'));
        }
        else{
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
    }

    public function submit(Request $request)
    {
        // Validation rules
        $rules = [
            'matricule' => 'required|unique:maitre_apprentis|string|max:255',
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
            'matricule.unique' => 'The matricule already exists.',           
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
            $maitre_apprentis->daterecrutement = $request->daterecrutement;
            $maitre_apprentis->affectation = $request->affectation;
            $maitre_apprentis->diplome_id = $request->diplome_id;
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
        $maitre_apprentis->diplome_id = $request->diplome_id;
        $maitre_apprentis->fonction = $request->fonction;
        $maitre_apprentis->daterecrutement = $request->daterecrutement;
        $maitre_apprentis->affectation = $request->affectation;
        $maitre_apprentis->statut = $request->statut;
        $maitre_apprentis->save();
        return redirect()->back()->with('success', 'Maitre d\'apprentissage modifie avec succes');
    }
    public function delete($id){
        supervisions::where('maitreapprenti_id',$id)->delete();
        pv_installations::where('maitreapprenti_id',$id)->update(['maitreapprenti_id' => null]);
        maitre_apprentis::destroy($id);
        return redirect()->back();
    }
    public function Historiquepayements(Request $request,$id){
        $maitre = maitre_apprentis::find($id);
        $pv = pv_installations::where('maitreapprenti_id',$maitre->id)->first();
        $decision = decisionmaitreapprentis::where('pv_id',$pv->id)->first();
        $baremes = baremes::all();
        $refs = refsalariares::all();
        return view('maitre_apprentis.Historique_payements',compact('maitre','decision','pv','baremes','refs'));
    }
    public function Historique(Request $request,$id){
        $maitre = maitre_apprentis::find($id);
        $supervisions = supervisions::where('maitreapprenti_id',$maitre->id)->get();
        $apprentis = apprentis::all();
        $specialites = specialites::all();
        $structures = structures::all();
        return view('maitre_apprentis.Historique_apprentis',compact('maitre','supervisions','apprentis','structures','specialites'));
    }
}
