<?php

namespace App\Http\Controllers;

use App\Models\apprentis;
use App\Models\maitre_apprentis;
use Illuminate\Http\Request;
use App\Models\departs;
use Auth;

class DepartsController extends Controller
{
    public function index()
    {
        $user = auth::user();
        $departs = departs::all();
        $apprentis = apprentis::all();
        return view('departs.index', compact('departs','apprentis','user'));
    }

    public function store(Request $request)
    {
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

        $maitre1 = maitre_apprentis::where('apprenti1_id',$request->apprenti_id)->first();
        $maitre2 = maitre_apprentis::where('apprenti2_id',$request->apprenti_id)->first();
        if($maitre1){
            $maitre1->apprenti1_id = null;
            $maitre1->save();
        }
        elseif($maitre2){
            $maitre2->apprenti2_id = null;
            $maitre2->save();
        }

        return redirect()->back()->with('success');
    }
}
