<?php

namespace App\Http\Controllers;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\parametres;
use Illuminate\Http\Request;
use App\Models\baremes;
use Session;
class DecisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametres = parametres::all();
        $baremes = baremes::all();
        $pv = Session::get('pv');
        $apprenti = Session::get('apprenti');
        $diplome1 = diplomes::where('id', $apprenti->diplome1_id)->first();
        $diplome2 = diplomes::where('id', $apprenti->diplome2_id)->first();
        (!is_null($diplome1)) ? $diplome = $diplome1 : $diplome = $diplome2;
        $maitreapprenti1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
        $maitreapprenti2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
        (!is_null($maitreapprenti1)) ? $maitreapprenti = $maitreapprenti1 : $maitreapprenti = $maitreapprenti2;
        return view('decisions.index', compact('parametres','baremes','pv','apprenti','maitreapprenti','diplome'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pv = Session::get('pv');
        $decisiona = new decisionapprentis();
        $decisiona->referenceda = $request->reference; 
        $decisiona->dateda = $request->datedecision;
        $decisiona->pv_id = $pv->id;
        $decisiona->parametre_id = $request->parametre_id;
        $decisiona->bareme_id = $request->bareme_id;
        $decisiona->datetransfert = $request->datetransfert;
        $decisiona->save();
        $decisionma = new decisionmaitreapprentis();
        $decisionma->referencedma = $request->reference;
        $decisionma->datedma = $request->datedecision;
        $decisionma->pv_id = $pv->id;
        $decisionma->parametre_id = $request->parametre_id;
        $decisionma->bareme_id = $request->bareme_id;
        $decisionma->save();
        $apprenti = Session::get('apprenti');
        return redirect()->route('dossiers.index', compact('apprenti'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
