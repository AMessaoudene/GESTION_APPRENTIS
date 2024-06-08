<?php

namespace App\Http\Controllers;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\parametres;
use App\Models\planbesoins;
use App\Models\specialites;
use App\Models\structures;
use App\Models\refsalariares;
use Illuminate\Http\Request;
use App\Models\baremes;
use Session;
use Validator;
use Auth;
class DecisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->status == 'active'){
            $plans = planbesoins::all();
            $parametres = parametres::all();
            $baremes = baremes::all();
            $specialites = specialites::all();
            $structures = structures::all();
            $refs = refsalariares::all();
            $diplomes = diplomes::all();
            $pv = Session::get('pv');
            $apprenti = Session::get('apprenti');
            $diplome1 = diplomes::where('id', $apprenti->diplome1_id)->first();
            $diplome2 = diplomes::where('id', $apprenti->diplome2_id)->first();
            (!is_null($diplome1)) ? $diplome = $diplome1 : $diplome = $diplome2;
            $maitreapprenti1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
            $maitreapprenti2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
            (!is_null($maitreapprenti1)) ? $maitreapprenti = $maitreapprenti1 : $maitreapprenti = $maitreapprenti2;
            return view('decisions.index', compact('apprenti','diplomes','refs','structures','specialites','parametres','baremes','pv','apprenti','maitreapprenti','diplome','plans'));
        }else{
            return redirect()->back()->with('no access');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $rules = [
            'referenceda' => 'required|unique:decisionapprentis',
            'planbesoins_id' => 'required',
            'parametre_id' => 'required',
            'bareme_id' => 'required',
            'datedecision' => 'required',
            'pv_id' => 'required',
            'referencedma' => 'required',
            'datedma' => 'required',
            'dateda' =>'required'
        ];
        $messages = [
            'referenceda.required' => 'Le champ reference est obligatoire.',
            'referenceda.unique' => 'Le champ reference doit etre unique.',
            'planbesoins_id.required' => 'Le champ plan de besoin est obligatoire.',
            'parametre_id.required' => 'Le champ parametre est obligatoire.',
            'bareme_id.required' => 'Le champ bareme est obligatoire.',
            'datedecision.required' => 'Le champ date de decision est obligatoire.',
            'pv_id.required' => 'Le champ pv est obligatoire.',
            'referencedma.required' => 'Le champ reference est obligatoire.',
            'datedma.required' => 'Le champ date de decision est obligatoire.',
            'dateda.required' => 'Le champ date de decision est obligatoire.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pv = Session::get('pv');
        $decisiona = new decisionapprentis();
        $decisiona->planbesoins_id = $request->planbesoins_id;
        $decisiona->referenceda = $request->reference; 
        $decisiona->dateda = $request->datedecision;
        $decisiona->pv_id = $pv->id;
        $decisiona->parametre_id = $request->parametre_id;
        $decisiona->bareme_id = $request->bareme_id;
        $decisiona->datetransfert = $request->datetransfert;
        $decisiona->datedebutpresalaireS1 = $request->datedebutpresalaireS1;
        $decisiona->datedebutpresalaireS2 = $request->datedebutpresalaireS2;
        $decisiona->datedebutpresalaireS3 = $request->datedebutpresalaireS3;
        $decisiona->datedebutpresalaireS4 = $request->datedebutpresalaireS4;
        $decisiona->datedebutpresalaireS5 = $request->datedebutpresalaireS5;
        $decisiona->datefinpresalaireS1 = $request->datefinpresalaireS1;
        $decisiona->datefinpresalaireS2 = $request->datefinpresalaireS2;
        $decisiona->datefinpresalaireS3 = $request->datefinpresalaireS3;
        $decisiona->datefinpresalaireS4 = $request->datefinpresalaireS4;
        $decisiona->datefinpresalaireS5 = $request->datefinpresalaireS5;
        $decisiona->save();
        $decisionma = new decisionmaitreapprentis();
        $decisionma->referencedma = $request->reference;
        $decisionma->datedma = $request->datedecision;
        $decisionma->pv_id = $pv->id;
        $decisionma->parametre_id = $request->parametre_id;
        $decisionma->bareme_id = $request->bareme_id;
        $decisionma->datedebutsalaireS1 = $request->datedebutsalaireS1;
        $decisionma->datedebutsalaireS2 = $request->datedebutsalaireS2;
        $decisionma->datedebutsalaireS3 = $request->datedebutsalaireS3;
        $decisionma->datedebutsalaireS4 = $request->datedebutsalaireS4;
        $decisionma->datedebutsalaireS5 = $request->datedebutsalaireS5;
        $decisionma->datefinsalaireS1 = $request->datefinsalaireS1;
        $decisionma->datefinsalaireS2 = $request->datefinsalaireS2;
        $decisionma->datefinsalaireS3 = $request->datefinsalaireS3;
        $decisionma->datefinsalaireS4 = $request->datefinsalaireS4;
        $decisionma->datefinsalaireS5 = $request->datefinsalaireS5;
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
