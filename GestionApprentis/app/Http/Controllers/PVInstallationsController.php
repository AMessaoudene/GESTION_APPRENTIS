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
        $rules = [
            'reference' => 'required',
            'direction' =>'required',
            'datepv' => 'required',
            'dateinstallationchiffre' => 'required',
            'anneeinstallationlettre' => 'required',
            'moisinstallationlettre' => 'required',
            'jourinstallationlettre' => 'required',
            'directionaffectation' => 'required',
            'serviceaffectation' => 'required',
            'dotations' => 'required',
            'pdf' => 'required',
        ];
        $messages = [
          'reference.required'=>'La réference est obligatoire',
          'direction.required'=>'La direction est obligatoire',
          'datepv.required'=>'La date pv est obligatoire',
          'dateinstallationchiffre.required'=>'La date installation chiffre est obligatoire',
          'anneeinstallationlettre.required'=>'L\'annee installation lettre est obligatoire',
          'moisinstallationlettre.required'=>'Le mois installation lettre est obligatoire',
          'jourinstallationlettre.required'=>'Le jour installation lettre est obligatoire',
          'directionaffectation.required'=>'La direction affectation est obligatoire',
          'serviceaffectation.required'=>'Le service affectation est obligatoire',
          'dotations.required'=>'Les dotations sont obligatoires',
          'pdf.required'=>'Le pdf est obligatoire',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, save the data
        $pv = new pv_installations();
        $pv->reference = $request->input('reference');
        $pv->direction = $request->input('direction');
        $pv->datepv = $request->input('datepv');
        $pv->dateinstallationchiffre = $request->input('dateinstallationchiffre');
        $pv->anneeinstallationlettre = $request->input('anneeinstallationlettre');
        $pv->moisinstallationlettre = $request->input('moisinstallationlettre');
        $pv->jourinstallationlettre = $request->input('jourinstallationlettre');
        $pv->directionaffectation = $request->input('directionaffectation');
        $pv->serviceaffectation = $request->input('serviceaffectation');
        $pv->dotations = $request->input('dotations');
        $pv->pdf = $request->input('pdf');
        $pv->save();

        $transferredData = $request->all();
        Session::put('transferredData', $transferredData);
        return redirect()->route('dossiers.index');
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
