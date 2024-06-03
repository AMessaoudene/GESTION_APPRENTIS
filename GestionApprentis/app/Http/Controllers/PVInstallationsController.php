<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\pv_installations;
use App\Models\maitre_apprentis;
use Illuminate\Http\Request;



class PVInstallationsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apprenti = Session::get('apprenti');
        $maitre_apprentis = maitre_apprentis::all();
        // Pass transferred data to the view
        return view('pvinstallations.index', compact('maitre_apprentis'))->with('apprenti', $apprenti);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $apprenti = Session::get('apprenti');
        $rules = [
            'reference' => 'required',
            'direction' =>'required',
            /*'datepv' => 'required',
            'dateinstallationchiffre' => 'required',
            'anneeinstallationlettre' => 'required',
            'moisinstallationlettre' => 'required',
            'jourinstallationlettre' => 'required',
            'directionaffectation' => 'required',
            'serviceaffectation' => 'required',
            'dotations' => 'required',*/
        ];
        $messages = [
          'reference.required'=>'La réference est obligatoire',
          'direction.required'=>'La direction est obligatoire',
          /*'datepv.required'=>'La date pv est obligatoire',
          'dateinstallationchiffre.required'=>'La date installation chiffre est obligatoire',
          'anneeinstallationlettre.required'=>'L\'annee installation lettre est obligatoire',
          'moisinstallationlettre.required'=>'Le mois installation lettre est obligatoire',
          'jourinstallationlettre.required'=>'Le jour installation lettre est obligatoire',
          'directionaffectation.required'=>'La direction affectation est obligatoire',
          'serviceaffectation.required'=>'Le service affectation est obligatoire',
          'dotations.required'=>'Les dotations sont obligatoires',*/
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        /*$pv = session::get('pv_installations');

        if(!$pv){
            // Initialize a new instance only if session data doesn't exist
            
        }*/
        try{
        if(session::has('reference')){
            $pv = pv_installations::where('reference', session::get('reference'))->first();
            if($pv){
                $pv = pv_installations::update(request()->all());
                session::put('pv',$pv);
                //Session::put('apprenti', $apprenti);
                return redirect()->route('decisions.index');
            }
            else{
                $pv = new pv_installations();
                $pv->reference = $request->reference;
                $pv->direction = $request->direction;
                $pv->datepv = $request->datepv;
                $pv->dateinstallationchiffre = $request->dateinstallationchiffre;
                $pv->anneeinstallationlettre = $request->anneeinstallationlettre;
                $pv->moisinstallationlettre = $request->moisinstallationlettre;
                $pv->jourinstallationlettre = $request->jourinstallationlettre;
                $pv->directionaffectation = $request->directionaffectation;
                $pv->serviceaffectation = $request->serviceaffectation;
                $pv->dotations = $request->dotations;
                $pv->apprenti_id = $apprenti->id;
                $maitre_apprentis1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
                $maitre_apprentis2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
                is_null($maitre_apprentis1) ? $maitre_apprentis = $maitre_apprentis2 : $maitre_apprentis = $maitre_apprentis1;
                $pv->maitreapprenti_id = $maitre_apprentis->id;
                $pv->save();
                Session::put('pv', $pv);
                //Session::put('apprenti', $apprenti);
                return redirect()->route('decisions.index');
            }
        }else{
            $pv = new pv_installations();
            $pv->reference = $request->reference;
            $pv->direction = $request->direction;
            $pv->datepv = $request->datepv;
            $pv->dateinstallationchiffre = $request->dateinstallationchiffre;
            $pv->anneeinstallationlettre = $request->anneeinstallationlettre;
            $pv->moisinstallationlettre = $request->moisinstallationlettre;
            $pv->jourinstallationlettre = $request->jourinstallationlettre;
            $pv->directionaffectation = $request->directionaffectation;
            $pv->serviceaffectation = $request->serviceaffectation;
            $pv->dotations = $request->dotations;
            $pv->apprenti_id = $apprenti->id;
            $maitre_apprentis1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
            $maitre_apprentis2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
            is_null($maitre_apprentis1) ? $maitre_apprentis = $maitre_apprentis2 : $maitre_apprentis = $maitre_apprentis1;
            $pv->maitreapprenti_id = $maitre_apprentis->id;
            $pv->save();

            Session::put('pv', $pv);
            Session::put('apprenti', $apprenti);
            return redirect()->route('decisions.index');
        }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function pdf(){
        $transferredData = Session::get('transferredData');
        return view('pvinstallations.pdf', compact('transferredData'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = pv_installations::all();
        return view('pvinstallations.show', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
