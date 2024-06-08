<?php

namespace App\Http\Controllers;
use App\Models\parametres;
use App\Models\decisionapprentis;
use App\Models\decisionmaitreapprentis;
use Illuminate\Http\Request;
use Validator;
use Auth;
class ParametresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth::user()->status == 'active'){
            $user = auth::user();
            $parametres = parametres::all();
            return view('parametres.index', compact('parametres','user'));
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

        ];
        $messages = [

        ];
        $validate=Validator::make($request->all(), $rules, $messages);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            try{
                parametres::where('status','actif')->update(['status'=>'inactif']);
                $parametres = new parametres();
                $parametres->fill($request->all());
                $parametres->save();
                return redirect()->back();   
            }
            catch(\Exception $e){
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    public function update(Request $request,$id)
    {
        $parametre = parametres::findOrFail($id);
        $parametre->reference = $request->reference;
        $parametre->decisionresponsable = $request->decisionresponsable;
        $parametre->datedecisionresponsable = $request->datedecisionresponsable;
        $parametre->statut = $request->statut;
        $parametre->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Set planbesoins_id to null for related records in decisionapprentis and decisionmaitreapprentis
        decisionapprentis::where('parametre_id', $id)->update(['parametre_id' => null]);
        decisionmaitreapprentis::where('parametre_id', $id)->update(['parametre_id' => null]);
        
        parametres::destroy($id);
        return redirect()->back()->with('success');
    }
}
