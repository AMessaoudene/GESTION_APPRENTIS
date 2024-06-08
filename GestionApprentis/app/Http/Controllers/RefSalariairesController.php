<?php

namespace App\Http\Controllers;
use App\Models\baremes;
use App\Models\decisionapprentis;
use App\Models\refsalariares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RefSalariairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth::user()->status == 'active'){
            $refsalariaires = refsalariares::all();
            return view('refsalariaires.index', compact('refsalariaires'));
        }
        else{
            return redirect()->back()->with('no access');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $rules = [
            'version' => 'required',
            'snmg' => 'required',
            'salairereference' => 'required',
        ];
        $messages = [
            'version.required' => 'Version est requise',
            'snmg.required' => 'SNMG est requise',
            'salairereference.required' => 'Salaire est requise',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        refsalariares::where('status','actif')->update(['status'=>'inactif']);
        $refsalariares = new refsalariares();
        $refsalariares->version = $request->version;
        $refsalariares->snmg = $request->snmg;
        $refsalariares->salairereference = $request->salairereference;
        $refsalariares->save();
        return redirect('/refsalariaires');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $baremes = baremes::where('refsalariaires_id',$id);
        $baremes->delete();
        refsalariares::destroy($id);
        return redirect()->back();
    }
}
