<?php

namespace App\Http\Controllers;
use App\Models\parametres;
use App\Models\planbesoins;
use App\Models\structures;
use Validator;
use Illuminate\Http\Request;
use App\Models\baremes;
use App\Models\dossiers;
use App\Models;
use Auth;
use App\Models\apprentis;
use App\Models\pv_installations;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\diplomes;
use App\Models\specialites;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\maitre_apprentis;

class DossiersController extends Controller
{
    public function download(){
        $apprenti = Session::get('apprenti');
        $data = session::get('transferredData');
        return view("pvinstallations.fiche",['data' => $data, 'apprenti' => $apprenti]);
    }
    public function index(){
        $data = session::get('transferredData');
        $apprenti = Session::get('apprenti');
        $dossiers = dossiers::all();
        return view("dossiers.index",['data' => $data, 'apprenti' => $apprenti, 'dossiers' => $dossiers]);
    }
    public function store(Request $request){
        $apprenti = Session::get('apprenti');
        $rules = [
            'contratapprenti' => 'required',
            'decisionapprenti' => 'required',
            'decisionmaitreapprenti' => 'required',
            'pvinstallation' => 'required',
            'copiecheque' => 'required',
            'extraitnaissance' => 'required',
        ];
        $message = [
            'contratapprenti.required' => 'The contratapprenti field is required.',
            'decisionapprenti.required' => 'The decisionapprenti field is required.',
            'decisionmaitreapprenti.required' => 'The decisionmaitreapprenti field is required.',
            'pvinstallation.required' => 'The pvinstallation field is required.',
            'copiecheque.required' => 'The copiecheque field is required.',
            'extraitnaissance.required' => 'The extraitnaissance field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            try{
            $dossiers = new dossiers();
            $dossiers->apprentis_id = $apprenti->id;

            $contratapprenti = $request->file('contratapprenti');
            $contratapprentinom = 'Contrat-Apprenti-'.$apprenti->id.'-'.time().'.'.$contratapprenti->getClientOriginalExtension();
            $contratapprenti->move('assets/dossiers',$contratapprentinom);
            $dossiers->contratapprenti = $contratapprentinom;

            $decisionapprenti = $request->file('decisionapprenti');
            $decisionapprentinom = 'DecisionA-Apprenti-'.$apprenti->id.'-'.time().'.'.$decisionapprenti->getClientOriginalExtension();
            $decisionapprenti->move('assets/dossiers',$decisionapprentinom);
            $dossiers->decisionapprenti = $decisionapprentinom;

            $decisionmaitreapprenti = $request->file('decisionmaitreapprenti');
            $decisionmaitreapprentinom = 'DecisionMA-Apprenti-'.$apprenti->id.'-'.time().'.'.$decisionmaitreapprenti->getClientOriginalExtension();
            $decisionmaitreapprenti->move('assets/dossiers',$decisionmaitreapprentinom);
            $dossiers->decisionmaitreapprenti = $decisionmaitreapprentinom;

            $pvinstallation = $request->file('pvinstallation');
            $pvinstallationnom = 'PV-Apprenti-'.$apprenti->id.'-'.time().'.'.$pvinstallation->getClientOriginalExtension();
            $pvinstallation->move('assets/dossiers',$pvinstallationnom);
            $dossiers->pvinstallation = $pvinstallationnom;

            $copiecheque = $request->file('copiecheque');
            $copiechequenom = 'CopieCheque-Apprenti-'.$apprenti->id.'-'.time().'.'.$copiecheque->getClientOriginalExtension();
            $copiecheque->move('assets/dossiers',$copiechequenom);
            $dossiers->copiecheque = $copiechequenom;

            $extraitnaissance = $request->file('extraitnaissance');
            $extraitnaissancenom = 'ExtraitNaissance-Apprenti-'.$apprenti->id.'-'.time().'.'.$extraitnaissance->getClientOriginalExtension();
            $extraitnaissance->move('assets/dossiers',$extraitnaissancenom);
            $dossiers->extraitnaissance = $extraitnaissancenom;

            if($request->hasFile('autorisationparentele') && $request->file('autorisationparentele')){
                $autorisationparentele = $request->file('autorisationparentele');
                $autorisationparentelenom = 'Autorisation-Apprenti-'.$apprenti->id.'-'.time().'.'.$autorisationparentele->getClientOriginalExtension();
                $autorisationparentele->move('assets/dossiers',$autorisationparentelenom);
                $dossiers->autorisationparentele = $autorisationparentelenom;
            }
            
            if($request->hasFile('photo') && $request->file('photo')){
                $photo = $request->file('photo');
                $photonom = 'Photo-Apprenti-'.$apprenti->id.'-'.time().'.'.$photo->getClientOriginalExtension();
                $photo->move('assets/dossiers',$photonom);
                $dossiers->photo = $photonom;
            }

            if($request->hasFile('pieceidentite') && $request->file('pieceidentite')){
                $pieceidentite = $request->file('pieceidentite');
                $pieceidentitenom = 'pieceidentite-Apprenti-'.$apprenti->id.'-'.time().'.'.$pieceidentite->getClientOriginalExtension();
                $pieceidentite->move('assets/dossiers',$pieceidentitenom);
                $dossiers->pieceidentite = $pieceidentitenom;
            }

            $dossiers->save();
            return redirect()->route('apprentis.consulter');
            }catch(\Exception $e){
                return redirect()->back()->with('error','Dossier non enregistre');
            }
        }
    }
    public function modify(Request $request){
        $rules = [
            'status' => 'required',
            'motif' => 'required|string|max:1000',
        ];
        $message = [
            'status.required' => 'The status field is required.',
            'motif.required' => 'The motif field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $dossiers = new dossiers();
            $dossiers->status = $request->input('status');
            $dossiers->motif = $request->input('motif');
            $dossiers->save();
            return redirect()->back()->with('success','');
        }
    }
    public function pdfdownload(Request $request,$file){
        return response()->download('assets/dossiers/'.$file);
    }
    public function delete(Request $request,$id){
        $dossiers = dossiers::findOrFail($id);
        $dossiers->delete();
        return redirect()->back();
    }
    public function details(Request $request,$id){
        $apprenti = apprentis::findOrFail($id);
        $dossier = dossiers::where('apprenti_id',$apprenti->id);
        return view('dossiers.details',compact('apprenti'));
    }

    public function updateindex(Request $request,$id){
        $user = auth::user();
        $apprenti = apprentis::findOrFail($id);
        $dossiers = dossiers::all();
        $specialites = specialites::all();
        $structures = structures::all();
        $diplomes = diplomes::all();
        $pvs = pv_installations::all();
        $decisionapprentis = decisionapprentis::all();
        $decisionmaitreapprentis = decisionmaitreapprentis::all();
        $maitreapprentis = maitre_apprentis::all();
        $parametres = parametres::all();
        $baremes = baremes::all();
        $planbesoins = planbesoins::all();
        return view('dossiers.update',compact('apprenti','user','baremes','parametres','dossiers','specialites','structures','planbesoins','pvs','diplomes','decisionapprentis','decisionmaitreapprentis','maitreapprentis'));
    }
    public function update(Request $request,$id){
        $apprenti = apprentis::findOrFail($id);
        $apprenti->nom = $request->nom;
        $apprenti->prenom = $request->prenom;
        $apprenti->civilite = $request->civilite;
        $apprenti->adresse = $request->adresse;
        $apprenti->telephone = $request->telephone;
        $apprenti->email = $request->email;
        $apprenti->datenaissance = $request->datenaissance;
        $apprenti->numcontrat = $request->numcontrat;
        $apprenti->specialite_id = $request->specialite_id;
        $apprenti->structure_id = $request->structure_id;
        $apprenti->diplome1_id = $request->diplome1_id;
        $apprenti->diplome2_id = $request->diplome2_id;
        $apprenti->save();

        $pv = pv_installations::where('apprenti_id',$apprenti->id);
        $pv->reference = $request->reference;
        $pv->datepv = $request->datepv;
        $pv->maitreapprenti_id = $request->maitreapprenti_id;
        $pv->dateinstallation = $request->dateinstallation;
        $pv->anneeinstallationlettre = $request->anneeinstallationlettre;
        $pv->moisinstallationlettre = $request->moisinstallationlettre;
        $pv->jourinstallationlettre = $request->jourinstallationlettre;
        $pv->save();

        $decisionapprenti = decisionapprentis::where('pv_id',$pv->id);
        $decisionapprenti->referenceda = $request->referenceda;
        $decisionapprenti->dateda = $request->dateda;
        $decisionapprenti->planbesoins_id = $request->planbesoins_id;
        $decisionapprenti->parametre_id = $request->parametre_id;
        $decisionapprenti->bareme_id = $request->bareme_id;
        $decisionapprenti->datetransfert = $request->datetransfert;
        $decisionapprenti->save();

        $decisionmaitreapprenti = decisionmaitreapprentis::where('pv_id',$pv->id);
        $decisionmaitreapprenti->referencedma = $request->referencedma;
        $decisionmaitreapprenti->datedma = $request->datedma;
        $decisionmaitreapprenti->parametre_id = $request->parametre_id;
        $decisionmaitreapprenti->bareme_id = $request->bareme_id;
        $decisionmaitreapprenti->save();

        $dossier = dossiers::where('apprenti_id',$apprenti->id);
        $contratapprenti = $request->file('contratapprenti');
        $contratapprentinom = 'Contrat-Apprenti-'.$apprenti->id.'-'.time().'.'.$contratapprenti->getClientOriginalExtension();
        $contratapprenti->move('assets/dossiers',$contratapprentinom);
        $dossier->contratapprenti = $contratapprentinom;

        $decisionapprenti = $request->file('decisionapprenti');
        $decisionapprentinom = 'DecisionA-Apprenti-'.$apprenti->id.'-'.time().'.'.$decisionapprenti->getClientOriginalExtension();
        $decisionapprenti->move('assets/dossiers',$decisionapprentinom);
        $dossier->decisionapprenti = $decisionapprentinom;

        $decisionmaitreapprenti = $request->file('decisionmaitreapprenti');
        $decisionmaitreapprentinom = 'DecisionMA-Apprenti-'.$apprenti->id.'-'.time().'.'.$decisionmaitreapprenti->getClientOriginalExtension();
        $decisionmaitreapprenti->move('assets/dossiers',$decisionmaitreapprentinom);
        $dossier->decisionmaitreapprenti = $decisionmaitreapprentinom;

        $pvinstallation = $request->file('pvinstallation');
        $pvinstallationnom = 'PV-Apprenti-'.$apprenti->id.'-'.time().'.'.$pvinstallation->getClientOriginalExtension();
        $pvinstallation->move('assets/dossiers',$pvinstallationnom);
        $dossier->pvinstallation = $pvinstallationnom;

        $copiecheque = $request->file('copiecheque');
        $copiechequenom = 'CopieCheque-Apprenti-'.$apprenti->id.'-'.time().'.'.$copiecheque->getClientOriginalExtension();
        $copiecheque->move('assets/dossiers',$copiechequenom);
        $dossier->copiecheque = $copiechequenom;

        $extraitnaissance = $request->file('extraitnaissance');
        $extraitnaissancenom = 'ExtraitNaissance-Apprenti-'.$apprenti->id.'-'.time().'.'.$extraitnaissance->getClientOriginalExtension();
        $extraitnaissance->move('assets/dossiers',$extraitnaissancenom);
        $dossier->extraitnaissance = $extraitnaissancenom;

        if($request->hasFile('autorisationparentele') && $request->file('autorisationparentele')){
            $autorisationparentele = $request->file('autorisationparentele');
            $autorisationparentelenom = 'Autorisation-Apprenti-'.$apprenti->id.'-'.time().'.'.$autorisationparentele->getClientOriginalExtension();
            $autorisationparentele->move('assets/dossiers',$autorisationparentelenom);
            $dossier->autorisationparentele = $autorisationparentelenom;
        }
            
        if($request->hasFile('photo') && $request->file('photo')){
            $photo = $request->file('photo');
            $photonom = 'Photo-Apprenti-'.$apprenti->id.'-'.time().'.'.$photo->getClientOriginalExtension();
            $photo->move('assets/dossiers',$photonom);
            $dossier->photo = $photonom;
        }

        if($request->hasFile('pieceidentite') && $request->file('pieceidentite')){
            $pieceidentite = $request->file('pieceidentite');
            $pieceidentitenom = 'pieceidentite-Apprenti-'.$apprenti->id.'-'.time().'.'.$pieceidentite->getClientOriginalExtension();
            $pieceidentite->move('assets/dossiers',$pieceidentitenom);
            $dossier->pieceidentite = $pieceidentitenom;
        }

        $dossier->status = 'en cours';
        $dossier->save();

        return redirect('/apprentis/consulter');
    }
    public function deletefichier(Request $request, $id, $fichier)
{
    $dossier = Dossiers::find($id);

    if ($dossier) {
        switch ($fichier) {
            case 'contratapprenti':
                $dossier->contratapprenti = '';
                break;
            case 'decisionapprenti':
                $dossier->decisionapprenti = '';
                break;
            case 'decisionmaitreapprenti':
                $dossier->decisionmaitreapprenti = '';
                break;
            case 'pvinstallation':
                $dossier->pvinstallation = '';
                break;
            case 'copiecheque':
                $dossier->copiecheque = '';
                break;
            case 'extraitnaissance':
                $dossier->extraitnaissance = '';
                break;
            case 'autorisationparentale':
                $dossier->autorisationparentale = '';
                break;
            case 'photo':
                $dossier->photo = '';
                break;
            case 'pieceidentite':
                $dossier->pieceidentite = '';
                break;
            default:
                return redirect()->back()->with('error', 'Invalid file type.');
        }
        $dossier->save();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    return redirect()->back()->with('error', 'Dossier not found.');
}

}
