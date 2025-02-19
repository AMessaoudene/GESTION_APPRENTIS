<?php

namespace App\Http\Controllers;
use App\Models\specialites;
use Illuminate\Http\Request;
use Validator;
use App\Models\maitre_apprentis;
use Illuminate\Support\Facades\Auth;
use App\Models\Apprentis;
class SpecialitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->status == 'active'){
            $specialites = specialites::all();
            return view('specialites.index', compact('specialites'));
        }
        else{
            return redirect()->back()->with('no access');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required',
        ];

        $validate=Validator::make($request->all(), $rules);
        
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            $specialites = new specialites();
            $specialites->nom = $request->nom;
            $specialites->description = $request->description;
            $specialites->save();
            return redirect()->back();
        }
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
    public function update(Request $request, $id)
    {
        $rules = [
            'nom' => 'required|unique:specialites|string|max:255',
        ];
        $messages = [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.unique' => 'Le champ nom doit etre unique.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $specialite = specialites::findOrFail($id);
        $specialite->nom = $request->nom;
        $specialite->description = $request->description;
        $specialite->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Apprentis::where('specialite_id',$id)->update(['specialite_id' => null]);
        maitre_apprentis::where('fonction',$id)->update(['fonction' => null]);
        specialites::destroy($id);
        return redirect()->back();
    }
}
