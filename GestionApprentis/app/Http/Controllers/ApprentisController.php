<?php

namespace App\Http\Controllers;
use App\Events\NewApprenticeAdded;
use App\Models\assiduites;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\evaluation_apprentis;
use App\Models\planbesoins;
use App\Models\supervisions;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\structures;
use App\Models\specialites;
use App\Models\dossiers;
use App\Models\pv_installations;
use Validator;
use Illuminate\Support\Facades\Auth;

class ApprentisController extends Controller
{
    public function index()
    {
        if(auth::user()->role == 'DFP' || auth::user()->role == 'SA'){
        $diplomes = diplomes::all();
        $maitre_apprentis = maitre_apprentis::all();
        $structures = structures::all();
        $specialites = specialites::all();
        return view('apprentis.index', compact('maitre_apprentis','diplomes','structures','specialites')); 
        }
        else{
            return redirect()->back();
        }
    }

    public function submit(Request $request){
        // Validation rules
        $rules = [
            'numcontrat' => 'required|unique:apprentis|string|max:255',
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
            'maitre_apprentis' => 'required',
        ];

        // Custom error messages
        $messages = [
            'numcontrat.required' => 'Le champ numéro de contrat est requis.',
            'datecontrat.required' => 'Le champ date de contrat est requis.',
            'datedebut.required' => 'Le champ date de debut est requis.',
            'datefin.required' => 'Le champ date de fin est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',
            'email.required' => 'Le champ email est requis.',
            'telephone.required' => 'Le champ telephone est requis.',
            'adresse.required' => 'Le champ adresse est requis.',
            'niveauscolaire.required' => 'Le champ niveau scolaire est requis.',
            'specialite_id.required' => 'Le champ specialite est requis.',
            'structure_id.required' => 'Le champ structure est requis.',
            'diplome1_id.required' => 'Le champ diplome est requis.',
            'maitre_apprentis.required' => 'Le champ maitre_apprentis est requis.',
            'numcontrat.unique' => 'Le numéro de contrat existe deja dans la base de données.',
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // Check if numcontrat exists in the session
            if (Session::has('numcontrat')) {
                // If numcontrat exists, update the corresponding record
                $apprenti = apprentis::where('numcontrat', Session::get('numcontrat'))->first();
                if ($apprenti) {
                    $apprenti->update($request->all());
                    Session::put('apprenti', $apprenti);
                    return redirect()->route('pvinstallations.index');
                }
                else{
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

                    $supervision = new supervisions();
                    $supervision->apprenti_id = $apprenti->id;
                    $supervision->maitreapprenti_id = $maitreApprenti->id;
                    $supervision->save();
                    // Dispatch the event
                    event(new NewApprenticeAdded($apprenti));

                    Session::put('apprenti', $apprenti);
                    return redirect()->route('pvinstallations.index');
                }
            }
            else{
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

                $supervision = new supervisions();
                $supervision->apprenti_id = $apprenti->id;
                $supervision->maitreapprenti_id = $maitreApprenti->id;
                $supervision->save();
                // Dispatch the event
                event(new NewApprenticeAdded($apprenti));

                Session::put('apprenti', $apprenti);
                return redirect()->route('pvinstallations.index');
            }
        }
        catch (\Exception $e) {
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
            return redirect()->back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        } 
        
    }

    // for SA
    public function update(Request $request,$id){
        $apprenti = apprentis::findOrFail($id);
        $apprenti->nom = $request->nom;
        $apprenti->prenom = $request->prenom;
        $apprenti->civilite = $request->civilite;
        $apprenti->email = $request->email;
        $apprenti->telephone = $request->telephone;
        $apprenti->adresse = $request->adresse;
        $apprenti->niveauscolaire = $request->niveauscolaire;
        $apprenti->specialite_id = $request->specialite_id;
        $apprenti->structure_id = $request->structure_id;
        $apprenti->diplome1_id = $request->diplome1_id;
        $apprenti->save();
        return redirect()->back()->with('success', 'Apprenti modifié avec succes');
    }

    // for DFP
    public function status(Request $request, $id){
        $apprenti = apprentis::find($id);
        $apprenti->status = $request->status;
        $apprenti->save();
        return redirect()->back()->with('success', 'Apprenti modifié avec succes');
    }

    public function destroy($id){
    
    $apprenti = apprentis::find($id);
    if (!$apprenti) {
        return redirect()->back()->with('error', 'Apprenti non trouvé');
    }

    pv_installations::where('apprenti_id', $apprenti->id)->delete();
    assiduites::where('apprenti_id',$apprenti->id)->delete();
    dossiers::where('apprentis_id',$apprenti->id)->delete();
    evaluation_apprentis::where('apprenti_id',$apprenti->id)->delete();    
    $maitreapprenti1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
    if ($maitreapprenti1) {
        $maitreapprenti1->apprenti1_id = null;
        $maitreapprenti = $maitreapprenti1;
        $maitreapprenti1->save();
    } else {
        $maitreapprenti2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
        if ($maitreapprenti2) {
            $maitreapprenti2->apprenti2_id = null;
            $maitreapprenti = $maitreapprenti2;
            $maitreapprenti2->save();
        }
    }

    $supervision = supervisions::where('apprenti_id', $apprenti->id)->where('maitreapprenti_id', $maitreapprenti->id)->first();

    if ($supervision) {
        $supervision->delete();
    }

    $apprenti->delete();

    return redirect()->back()->with('success', 'Apprenti supprimé avec succès');
}

    public function details(Request $request,$id){
        $user = auth::user();
        $apprenti = apprentis::find($id);
        $specialite = specialites::where('id', $apprenti->specialite_id)->first();
        $structure = structures::where('id', $apprenti->structure_id)->first();
        $diplome = diplomes::where('id', $apprenti->diplome1_id)->first();
        $dossiers = dossiers::all();
        $pv = pv_installations::where('apprenti_id', $apprenti->id)->first();
        $decisionapprentis = decisionapprentis::all();
        $decisionmaitreapprentis = decisionmaitreapprentis::all();
        $maitreapprentis = maitre_apprentis::all();
        $plans = planbesoins::all();
        return view('apprentis.details',compact('plans','user','apprenti','specialite','structure','diplome','dossiers','pv','decisionapprentis','decisionmaitreapprentis','maitreapprentis'));
    }

    public function updatedossier(Request $request,$id){
        $dossier = dossiers::find($id);
        $dossier->status = $request->status;
        $dossier->motif = $request->motif;
        $dossier->save();
        $apprenti = apprentis::where('id', $dossier->apprentis_id)->first();
        if($request->status == 'valide'){
            $pv = pv_installations::where('apprenti_id',$apprenti->id)->first();
            $decision = decisionapprentis::where('pv_id',$pv->id)->first();
            $plan = planbesoins::where('id',$decision->planbesoins_id)->first();
            $plan->nombreapprentisactuel++;
            $plan->save();
            $apprenti->status = 'actif';
        }
        else{
            $apprenti->status = 'inactif';
        }
        $apprenti->save();
        return redirect()->back()->with('success', 'Dossier modifié avec succes');
    }
    public function consulter(){
        $user = auth::user();
        $apprentis = Apprentis::all();
        $structures = Structures::all();
        $specialites = Specialites::all();
        $diplomes = Diplomes::all();
        $pvs = Pv_Installations::all();
        $decisionapprentis = DecisionApprentis::all();
    
        if(auth::user()){
            return view('apprentis.consulter', compact('user','apprentis','structures','specialites','diplomes','pvs','decisionapprentis'));   
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations pour consulter cette page');
        }
    }
    

    public function HistoriqueMA(Request $request,$id){
        $supervisions = supervisions::where('apprenti_id',$id)->get();
        $maitres = maitre_apprentis::all();
        $specialites = specialites::all();
        $structures = structures::all();
        return view('apprentis.historique_maitres',compact('supervisions','maitres','specialites','structures'));
    }
    public function HistoriqueAssiduites(Request $request,$id){
        $assiduites = assiduites::where('apprenti_id',$id)->get();
        return view('apprentis.historique_assiduites',compact('assiduites'));
    }
    public function Historiqueevaluations(Request $request,$id){
        $evaluations = evaluation_apprentis::where('apprenti_id',$id);
        return view('apprentis.Historique_evaluations',compact('evaluations'));
    }
}
