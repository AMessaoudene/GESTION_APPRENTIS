<?php

namespace App\Http\Controllers;

use App\Models\apprentis;
use App\Models\decisionapprentis;
use App\Models\maitre_apprentis;
use App\Models\planbesoins;
use App\Models\pv_installations;
use App\Models\supervisions;
use Illuminate\Http\Request;
use App\Models\departs;
use Auth;
use Validator;

class DepartsController extends Controller
{
    public function index()
    {
        if(auth::user()->status == 'active'){
            $user = auth::user();
            $departs = departs::all();
            $apprentis = apprentis::all();
            return view('departs.index', compact('departs','apprentis','user'));
        }else{
            return redirect()->back()->with('no access');
        }
    }

    public function store(Request $request){
        $rules = [
            'apprenti_id' => 'required',
            'datedepart' => 'required',
            'refcourrier' => 'required',
            'datecourrier' => 'required',
        ];
        $messages = [
            'apprenti_id.required' => 'Le champ apprenti est obligatoire.',
            'datedepart.required' => 'Le champ date depart est obligatoire.',
            'refcourrier.required' => 'Le champ reference courrier est obligatoire.',
            'datecourrier.required' => 'Le champ date courrier est obligatoire.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $departs = new departs();
        $departs->apprenti_id = $request->apprenti_id;
        $departs->datedepart = $request->datedepart;
        $departs->motif = $request->motif;
        $departs->refcourrier = $request->refcourrier;
        $departs->datecourrier = $request->datecourrier;
        $departs->save();
        // Retrieve the apprentice record
        $apprenti = apprentis::where('id', $request->apprenti_id)->first();

        // Update the status
        $apprenti->status = 'inactif';
        $apprenti->save();

        $pv = pv_installations::where('apprenti_id',$apprenti->id)->first();
        $decision = decisionapprentis::where('pv_id',$pv->id)->first();
        $plan = planbesoins::where('id',$decision->id)->first();
        $plan->nombreapprentisactuel--;
        $plan->save();

        $maitre1 = maitre_apprentis::where('apprenti1_id',$request->apprenti_id)->first();
        $maitre2 = maitre_apprentis::where('apprenti2_id',$request->apprenti_id)->first();
        if($maitre1){
            $maitre = $maitre1;
            $maitre->apprenti1_id = null;
        }
        elseif($maitre2){
            $maitre = $maitre2;
            $maitre->apprenti2_id = null;
        }
        $maitre->save();

        $supervision = supervisions::where('apprenti_id', $request->apprenti_id)
                          ->where('maitreapprenti_id', $maitre->id)
                          ->first(); // Assuming you want to get the first matching record

        if ($supervision) {
            $supervision->statut = 'inactif';
            $supervision->save();
        }

        return redirect()->back()->with('success');
    }
}
