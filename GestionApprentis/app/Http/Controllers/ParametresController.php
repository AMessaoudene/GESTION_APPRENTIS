<?php

namespace App\Http\Controllers;
use App\Models\parametres;
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
        if(auth::user()){
        $user = auth::user();
        $parametres = parametres::all();
        return view('parametres.index', compact('parametres','user'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        parametres::destroy($id);
        return redirect()->back()->with('success');
    }
}
