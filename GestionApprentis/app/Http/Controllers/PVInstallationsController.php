<?php

namespace App\Http\Controllers;
use App\Models\structures;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\pv_installations;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\maitre_apprentis;
use Illuminate\Http\Request;



class PVInstallationsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = structures::all();
        $apprenti = Session::get('apprenti');
        $maitre_apprentis = maitre_apprentis::all();
        // Pass transferred data to the view
        return view('pvinstallations.index', compact('apprenti','maitre_apprentis','structures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $apprenti = Session::get('apprenti');

    // Ensure $apprenti is not null and has an id
    if (!$apprenti || !isset($apprenti->id)) {
        return redirect()->back()->with('error', 'Apprenti not found or invalid.');
    }

    $rules = [
        'reference' => 'required',
        'direction' => 'required',
        // Other validation rules...
    ];

    $messages = [
        'reference.required' => 'La réference est obligatoire',
        'direction.required' => 'La direction est obligatoire',
        // Other validation messages...
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $pv = new pv_installations();
        $pv->apprenti_id = $apprenti->id;
        $pv->reference = $request->reference;
        $pv->datepv = $request->datepv;
        $pv->dateinstallationchiffre = $request->dateinstallationchiffre;
        $pv->anneeinstallationlettre = $request->anneeinstallationlettre;
        $pv->moisinstallationlettre = $request->moisinstallationlettre;
        $pv->jourinstallationlettre = $request->jourinstallationlettre;
        $pv->directionaffectation = $request->directionaffectation;
        $pv->serviceaffectation = $request->serviceaffectation;
        $pv->dotations = $request->dotations;

        // Fetch maitre_apprentis
        $maitre_apprentis1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
        $maitre_apprentis2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
        $maitre_apprentis = $maitre_apprentis1 ?: $maitre_apprentis2;

        if (!$maitre_apprentis) {
            return redirect()->back()->with('error', 'Maitre apprenti not found.');
        }

        $pv->maitreapprenti_id = $maitre_apprentis->id;
        $pv->save();

        Session::put('pv', $pv);
        return redirect()->route('decisions.index');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    public function pdf(){
        $transferredData = Session::get('transferredData');
        return view('pvinstallations.pdf', compact('transferredData'));
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
        // Set planbesoins_id to null for related records in decisionapprentis and decisionmaitreapprentis
        decisionapprentis::where('pv_id', $id)->update(['pv_id' => null]);
        decisionmaitreapprentis::where('pv_id', $id)->update(['pv_id' => null]);
        
        pv_installations::destroy($id);
        return redirect()->back()->with('success');
    }
}
