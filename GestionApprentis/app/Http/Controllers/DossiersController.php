<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use app\Models\dossiers;
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
        return view("dossiers.index",['data' => $data, 'apprenti' => $apprenti]);
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
            'autorisationparentele' => 'required',
            'photo' => 'required',
        ];
        $message = [
            'contratapprenti.required' => 'The contratapprenti field is required.',
            'decisionapprenti.required' => 'The decisionapprenti field is required.',
            'decisionmaitreapprenti.required' => 'The decisionmaitreapprenti field is required.',
            'pvinstallation.required' => 'The pvinstallation field is required.',
            'copiecheque.required' => 'The copiecheque field is required.',
            'extraitnaissance.required' => 'The extraitnaissance field is required.',
            'autorisationparentele.required' => 'The autorisationparentele field is required.',
            'photo.required' => 'The photo field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            try{
            $dossiers = new dossiers();
            $dossiers->apprenti_id = $apprenti->id;
            /*$file=$request->file;
		        
	$filename=time().'.'.$file->getClientOriginalExtension();

		        $request->file->move('assets',$filename);

		        $data->file=$filename;*/
            $contratapprenti = $request->contratapprenti;
            $contratapprentinom = time().'.'.$contratapprenti->getClientOriginalExtension();
            $request->$contratapprenti->move('assets',$contratapprentinom);
            $dossiers->contratapprenti = $contratapprentinom;

            $decisionapprenti = $request->decisionapprenti;
            $decisionapprentinom = time().'.'.$decisionapprenti->getClientOriginalExtension();
            $request->$decisionapprenti->move('assets',$decisionapprentinom);
            $dossiers->decisionapprenti = $decisionapprentinom;

            $decisionmaitreapprenti = $request->decisionmaitreapprenti;
            $decisionmaitreapprentinom = time().'.'.$decisionmaitreapprenti->getClientOriginalExtension();
            $request->$decisionmaitreapprenti->move('assets',$decisionmaitreapprentinom);
            $dossiers->decisionmaitreapprenti = $decisionmaitreapprentinom;

            $pvinstallation = $request->pvinstallation;
            $pvinstallationnom = time().'.'.$pvinstallation->getClientOriginalExtension();
            $request->$pvinstallation->move('assets',$pvinstallationnom);
            $dossiers->pvinstallation = $pvinstallationnom;

            $copiecheque = $request->copiecheque;
            $copiechequenom = time().'.'.$copiecheque->getClientOriginalExtension();
            $request->$copiecheque->move('assets',$copiechequenom);
            $dossiers->copiecheque = $copiechequenom;

            $extraitnaissance = $request->extraitnaissance;
            $extraitnaissancenom = time().'.'.$extraitnaissance->getClientOriginalExtension();
            $request->$extraitnaissance->move('assets',$extraitnaissancenom);
            $dossiers->extraitnaissance = $extraitnaissancenom;

            $autorisationparentele = $request->autorisationparentele;
            $autorisationparentelenom = time().'.'.$autorisationparentele->getClientOriginalExtension();
            $request->$autorisationparentele->move('assets',$autorisationparentelenom);
            $dossiers->autorisationparentele = $autorisationparentelenom;

            $photo = $request->photo;
            $photonom = time().'.'.$photo->getClientOriginalExtension();
            $request->$photo->move('assets',$photonom);
            $dossiers->photo = $photonom;

            $dossiers->save();
            return redirect()->back()->with('success','Dossier enregistre avec succes');
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


}
