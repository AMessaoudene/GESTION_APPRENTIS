<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\dossiers; // Fixed the namespace and case sensitivity issue here
use App\Models;
use App\Models\apprentis;
use App\Models\pv_installations;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $dossiers = dossiers::all(); // Fetch all dossiers
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

            /*$file=$request->file;	        
	        $filename=time().'.'.$file->getClientOriginalExtension();
		    $request->file->move('assets',$filename);
		    $data->file=$filename;*/

            $contratapprenti = $request->file('contratapprenti');
            $contratapprentinom = time().'.'.$contratapprenti->getClientOriginalExtension();
            $contratapprenti->move('assets/dossiers',$contratapprentinom);
            $dossiers->contratapprenti = $contratapprentinom;

            $decisionapprenti = $request->file('decisionapprenti');
            $decisionapprentinom = time().'.'.$decisionapprenti->getClientOriginalExtension();
            $decisionapprenti->move('assets/dossiers',$decisionapprentinom);
            $dossiers->decisionapprenti = $decisionapprentinom;

            $decisionmaitreapprenti = $request->file('decisionmaitreapprenti');
            $decisionmaitreapprentinom = time().'.'.$decisionmaitreapprenti->getClientOriginalExtension();
            $decisionmaitreapprenti->move('assets/dossiers',$decisionmaitreapprentinom);
            $dossiers->decisionmaitreapprenti = $decisionmaitreapprentinom;

            $pvinstallation = $request->file('pvinstallation');
            $pvinstallationnom = time().'.'.$pvinstallation->getClientOriginalExtension();
            $pvinstallation->move('assets/dossiers',$pvinstallationnom);
            $dossiers->pvinstallation = $pvinstallationnom;

            $copiecheque = $request->file('copiecheque');
            $copiechequenom = time().'.'.$copiecheque->getClientOriginalExtension();
            $copiecheque->move('assets/dossiers',$copiechequenom);
            $dossiers->copiecheque = $copiechequenom;

            $extraitnaissance = $request->file('extraitnaissance');
            $extraitnaissancenom = time().'.'.$extraitnaissance->getClientOriginalExtension();
            $extraitnaissance->move('assets/dossiers',$extraitnaissancenom);
            $dossiers->extraitnaissance = $extraitnaissancenom;

            if($request->hasFile('autorisationparentele') && $request->file('autorisationparentele')){
                $autorisationparentele = $request->file('autorisationparentele');
                $autorisationparentelenom = time().'.'.$autorisationparentele->getClientOriginalExtension();
                $autorisationparentele->move('assets/dossiers',$autorisationparentelenom);
                $dossiers->autorisationparentele = $autorisationparentelenom;
            }
            
            if($request->hasFile('photo') && $request->file('photo')){
                $photo = $request->file('photo');
                $photonom = time().'.'.$photo->getClientOriginalExtension();
                $photo->move('assets/dossiers',$photonom);
                $dossiers->photo = $photonom;
            }

            $dossiers->save();
            return redirect()->route('dashboard');
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
}
