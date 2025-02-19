<?php

namespace App\Http\Controllers;
use App\Models\decisionapprentis;
use App\Models\diplomes;
use App\Models\pv_installations;
use App\Models\specialites;
use Illuminate\Support\Facades\Validator;
use App\Models\apprentis;
use App\Models\structures;
use App\Models\avenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth::user()->status == 'active'){
            $apprentis = apprentis::all();
            $decisions = decisionapprentis::all();
            $avenants = avenants::all();
            $diplomes = diplomes::all();
            $specialites = specialites::all();
            $structures = structures::all();
            $pvs = pv_installations::all();
            return view('avenants.index', compact('structures','specialites','decisions','pvs','avenants','apprentis','diplomes'));
        }
        else{
            return redirect()->back()->with('no access');
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'decisionapprenti_id' => 'required',
            'type' => 'required',
            'date' => 'required|date',
        ];

        $messages = [
            'decisionapprenti_id.required' => 'Le champ apprenti est obligatoire.',
            'type.required' => 'Le champ type est obligatoire.',
            'date.required' => 'Le champ date est obligatoire.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
                $avenant = new avenants();
                $avenant->decisionapprenti_id = $request->decisionapprenti_id;
                $avenant->type = $request->type;
                $avenant->date = $request->date;
                $avenant->save();
                $decision = decisionapprentis::where('id',$avenant->decisionapprenti_id)->first();
                $pv = pv_installations::where('id',$decision->pv_id)->first();
                $apprenti = apprentis::where('id',$pv->apprenti_id)->first();
                if($request->diplome_id){
                    $apprenti->diplome2_id = $request->diplome_id;
                }
                $apprenti->status = 'actif';
                $apprenti->save();
                return redirect()->back()->with('success', 'Assiduité ajoutée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
        /* Validate input fields */
        $rules = [
            'decisionapprenti_id' => 'required',
            'type' => 'required',
            'date' => 'required|date',
        ];

        $messages = [
            'decisionapprenti_id.required' => 'Le champ decisionapprenti_id est obligatoire.',
            'type.required' => 'Le champ type est obligatoire.',
            'date.required' => 'Le champ date est obligatoire.',
        ];

        $validator =Validator ::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else{
            $avenants = avenants::find($id);
            $avenants->decisionapprenti_id = $request->decisionapprenti_id;
            $avenants->type = $request->type;
            $avenants->date = $request->date;
            $avenants->save();
            return redirect()->back()->with('success', 'Assiduité modifié avec succès!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        
        try {
            $avenant = avenants::find($id);
            if (!$avenant) {
                return redirect()->back()->withErrors('Avenant not found')->withInput();
            }

            $decision = decisionapprentis::where('id', $avenant->decisionapprenti_id)->first();
            if (!$decision) {
                return redirect()->back()->withErrors('Decision not found')->withInput();
            }

            $pv = pv_installations::where('id', $decision->pv_id)->first();
            if (!$pv) {
                return redirect()->back()->withErrors('PV not found')->withInput();
            }

            $apprenti = apprentis::where('id', $pv->apprenti_id)->first();
            if (!$apprenti) {
                return redirect()->back()->withErrors('Apprenti not found')->withInput();
            }

            $apprenti->diplome2_id = null;
            $apprenti->save();
            $avenant->delete();

            return redirect()->back()->with('success', 'Avenant supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

}
